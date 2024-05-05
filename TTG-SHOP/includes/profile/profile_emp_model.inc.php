<?php

function get_product(object $pdo, string $product)
{

    $query = "SELECT product_name FROM products WHERE product_name = :product_name;";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    $stmt->bindParam(":product_name", $product);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch using name of the column

    return $result;
}

function  create_product(
    object $pdo,
    string $product,
    float $price,
    string $description,
    int $quantity,
    int $category,
    string $iconNewName,
    string $imageNewName,
    string $iconDestination,
    string $imageDestination
) {

    $query = "INSERT INTO products (product_name, product_price, product_description, category_id, product_quantity ) 
    VALUES (:product_name, :product_price, :product_description, :category_id, :product_quantity);
    SET @product_id = LAST_INSERT_ID();
    INSERT INTO images (image_name, image_destination)
    VALUES (:image_name, :image_destination);
    SET @image_id = LAST_INSERT_ID();
    INSERT INTO images (image_name, image_destination)
    VALUES (:icon_name, :icon_destination);
    SET @icon_id = LAST_INSERT_ID();
    INSERT INTO products_images (product_id, image_id) VALUES (@product_id, @image_id), (@product_id, @icon_id);";
    $stmt = $pdo->prepare($query);


    $stmt->bindParam(":product_name", $product);
    $stmt->bindParam(":product_price", $price);
    $stmt->bindParam(":product_description", $description);
    $stmt->bindParam(":product_quantity", $quantity);
    $stmt->bindParam(":category_id", $category);
    $stmt->bindParam(":image_name", $imageNewName);
    $stmt->bindParam(":image_destination", $imageDestination);
    $stmt->bindParam(":icon_name", $iconNewName);
    $stmt->bindParam(":icon_destination", $iconDestination);

    $stmt->execute();
}

function get_products(object $pdo)
{
    $query = "SELECT products.product_name,
    products.product_id, products.product_price, products.product_quantity , products.category_id,
    categories.category_name
    FROM products
    JOIN categories ON products.category_id = categories.category_id;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function search_products(object $pdo, string $search)
{
    $query = "SELECT products.product_name,
    products.product_id, products.product_price, products.product_quantity , products.category_id,
    categories.category_name
    FROM products
    JOIN categories ON products.category_id = categories.category_id
    WHERE products.product_name LIKE :search;";
    $stmt = $pdo->prepare($query);
    $searchParam = "%$search%";
    $stmt->bindParam(':search', $searchParam);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}