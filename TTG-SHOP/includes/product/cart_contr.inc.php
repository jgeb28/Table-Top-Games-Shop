<?php

declare(strict_types=1);

function does_product_exist(object $pdo, string $product)
{

    if (get_productId($pdo, $product)) {
        return true;
    } else {
        return false;
    }
}

function quantity_error(object $pdo, string $product, int $quantity) {
    $result = get_quantity($pdo, $product);
    if ($result['product_quantity'] < $quantity) {
        return true;
    } else {
        return false;
    }
}