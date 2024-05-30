<?php

declare(strict_types=1);



function is_input_empty(
    string $product,
    string $category,
    string $price,
    string $description,
    string $quantity,
    string $brand,
) {
    if (
        empty($product)  || empty($category) || empty($price) || empty($description) || !isset($quantity) || empty($brand) 
    ) {
        return true;
    } else {
        return false;
    }
}
function is_input_empty_img(
    int $iconSize,
    int $imageSize
) {
    if (
        $iconSize == 0 && $imageSize == 0
    ) {
        return true;
    } else {
        return false;
    }
}

function does_product_exist(object $pdo, string $product)
{

    if (get_productname($pdo, $product)) {
        return true;
    } else {
        return false;
    }
}

function file_errors(array $file)
{
    $errors = [];

    $fileName = $file['name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    if ($fileSize == 0) {
        $errors["file_not_given_$fileName"] = "Nie podano pliku/ów";
    } else {

        if ($fileError != 0) {
            $errors["uploading_error_$fileName"] = "Wystąpił błąd podczas wysyłania plik -> $fileName";
        }

        if ($fileSize > 500000) {
            $errors["size_wrong_$fileName"] = "Podano za duży plik -> $fileName";
        }

        $allowed = array('jpg', 'jpeg', 'png', 'webp');
        $filePreExt = explode('.', $fileName);
        $fileExt = strtolower((end($filePreExt)));

        if (!in_array($fileExt, $allowed)) {
            $errors["type_wrong_$fileName"] = "Podano zły typ pliku -> $fileName";
        }
    }
    return $errors;
}

function check_image_dimensions(array $file, int $width, int $height) {

    list($imgWidth, $imgHeight) = getimagesize($file['tmp_name']);
    if ($width != $imgWidth && $height != $imgHeight) {
        return true;
    }
    return false;
}

function is_productname_changed(object $pdo, string $productName, int  $userId) {

    $result = get_product_data($pdo, $userId);
    $oldName = $result["product_name"];

    if ($oldName != $productName) {
        return true;
    } else {
        return false;
    }
}

function only_one_image_added(int $iconSize, int $imageSize) {

    if ( ($iconSize == 0  && $imageSize != 0) || ($iconSize != 0  && $imageSize == 0)) 
    {
        return true;
    } else {
        return false;
    }
}

function check_if_two_value_given($playersMin,$playersMax) {
    if (
        !empty($playersMin)  &&  !empty($playersMax)
    ) {
        return true;
    } else {
        return false;
    }
}