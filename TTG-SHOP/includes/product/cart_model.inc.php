<?php

declare(strict_types=1);

function get_productId(object $pdo, string $product)
{

    $query = "SELECT product_id FROM products WHERE product_id = :product_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":product_id", $product);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); 

    return $result;
}

function get_quantity(object $pdo, string $product)
{

    $query = "SELECT product_quantity FROM products WHERE product_id = :product_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":product_id", $product);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); 

    return $result;
}

function get_cart_data(object $pdo,string $productId) {
    $query = "SELECT p.product_name, p.product_id, p.product_price, p.product_brand, i.image_destination
    FROM products p
    JOIN products_images pi ON p.product_id = pi.product_id
    JOIN images i ON pi.image_id = i.image_id
    WHERE p.product_id = :product_id AND i.image_type = 'small'";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $productId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}