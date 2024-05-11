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