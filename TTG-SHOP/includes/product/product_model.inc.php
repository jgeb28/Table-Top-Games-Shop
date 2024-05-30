<?php
declare(strict_types=1);

function get_product_data(object $pdo, int $productId) {
    $query = "SELECT products.product_name,
    products.product_id, products.product_price, products.product_quantity , products.category_id,
    products.product_description, products.product_age_class, products.product_brand, products.product_players_min, products.product_players_max,
    products.product_language, categories.category_name
    FROM products
    JOIN categories ON products.category_id = categories.category_id
    WHERE products.product_id = :product_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $productId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_product_images(object $pdo, int $productId) {
    $query = "SELECT images.image_destination
    FROM images
    JOIN products_images ON images.image_id = products_images.image_id
    WHERE products_images.product_id = :product_id;";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    $stmt->bindParam(":product_id", $productId);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    return $result;
}

function get_product_by_category(object $pdo, string $category, ?string $sort) {
    $query = "SELECT p.product_name, p.product_id, p.product_price, p.product_brand, p.product_quantity, i.image_destination
    FROM products p
    JOIN products_images pi ON p.product_id = pi.product_id
    JOIN images i ON pi.image_id = i.image_id
    WHERE p.category_id = :category_id AND i.image_type = 'small'";
    if($sort != null) {
        $query = $query . $sort;
    }
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':category_id', $category);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_product_by_name(object $pdo,string $name, ?string $sort) {
    $query = "SELECT p.product_name, p.product_id, p.product_price, p.product_brand, p.product_quantity, i.image_destination
    FROM products p
    JOIN products_images pi ON p.product_id = pi.product_id
    JOIN images i ON pi.image_id = i.image_id
    WHERE p.product_name LIKE :name AND i.image_type = 'small'";
    if($sort != null) {
        $query = $query . $sort;
    }
    $stmt = $pdo->prepare($query);
    $searchParam = "%$name%";
    $stmt->bindParam(':name', $searchParam);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_product_by_category_and_name(object $pdo, string $category, string $name, ?string $sort) {
    $query = "SELECT p.product_name, p.product_id, p.product_price, p.product_brand, p.product_quantity, i.image_destination
    FROM products p
    JOIN products_images pi ON p.product_id = pi.product_id
    JOIN images i ON pi.image_id = i.image_id
    WHERE p.product_name LIKE :name AND i.image_type = 'small' AND p.category_id = :category_id";
    if($sort != null) {
        $query = $query . $sort;
    }
    $stmt = $pdo->prepare($query);
    $searchParam = "%$name%";
    $stmt->bindParam(':name', $searchParam);
    $stmt->bindParam(':category_id', $category);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_new_products($pdo) {
    $query = "SELECT p.product_name, p.product_id, p.product_price, p.product_brand, p.product_quantity, i.image_destination
    FROM products p
    JOIN products_images pi ON p.product_id = pi.product_id
    JOIN images i ON pi.image_id = i.image_id
    WHERE i.image_type = 'small'
    ORDER BY p.product_id DESC
    LIMIT 20;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}