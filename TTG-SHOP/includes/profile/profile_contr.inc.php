<?php
declare(strict_types=1);



function is_input_empty(string $product, string $category, string $price,
string $description, string $quantity, array $icon, array $image) {
    if (empty($product)  || empty($category) || empty($price) || empty($description) || empty($quantity) || empty($icon)
    || empty($image)) {
        return true;
    } else {
        return false;
    }
}

function does_product_exist(object $pdo, string $product) {

    if(get_product($pdo, $product)) {
        return true;
    } else {
        return false;
    }
}

function file_errors(array $file) {
    $errors = [];

    $fileName = $file['name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];



    if($fileError != 0) {
        $errors["uploading_error_$fileName"] = "Wystąpił błąd podczas wysyłania plik -> $fileName";
    }

    if($fileSize > 500000) {
        $errors["size_wrong_$fileName"] = "Podano za duży plik -> $fileName";
    }

    $allowed = array('jpg', 'jpeg', 'png');
    $filePreExt = explode('.', $fileName);
    $fileExt = strtolower((end($filePreExt)));
    
    if(!in_array($fileExt, $allowed)) {
        $errors["type_wrong_$fileName"] = "Podano zły typ pliku -> $fileName";
    }

    return $errors;
}