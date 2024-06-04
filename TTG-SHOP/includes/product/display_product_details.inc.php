<?php
try {
    require_once 'includes/dbh.inc.php';
    require_once 'product_model.inc.php';

    if (isset($_GET["product"])) {
        $productId = $_GET["product"];
        $result = get_product_data($pdo, $productId);
        $resultImages = get_product_images($pdo, $productId);
        $_SESSION["product_data"] = $result;
        $_SESSION["product_images"] = $resultImages;
    }
    else {
        header("Location: /index.php");
    }
} catch (PDOException $e) {
    die("Querry Failed: " . $e->getMessage());
}
