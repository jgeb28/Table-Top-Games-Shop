<?php
try {
    require_once 'includes/dbh.inc.php';
    require_once 'product_model.inc.php';

    if (!isset($_SESSION["new_products"])) {
        $result = get_new_products($pdo);
        $_SESSION["new_products"] = $result;
    }
} catch (PDOException $e) {
    die("Querry Failed: " . $e->getMessage());
}
