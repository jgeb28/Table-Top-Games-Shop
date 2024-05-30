<?php
try {
    require_once 'includes/dbh.inc.php';
    require_once 'cart_model.inc.php';

    $subtotal = 0;

    if (isset($_SESSION["cart"])) {
        if(isset($_GET['remove'])) {
            $removedId = $_GET['remove'];
            unset($_SESSION["cart"][$removedId]);
        }
        $resoults = [];
        $i = 0;
        foreach (array_keys($_SESSION["cart"]) as $id) {
            $result = get_cart_data($pdo, $id);
            $result['product_quantity'] = $_SESSION["cart"][$id];
            $subtotal += $result['product_quantity'] * $result['product_price'];
            $resoults[$i] =$result;
            $i++;
        }
        $_SESSION['cart_list'] = $resoults;
    }
    else {
        header("Location: /index.php");
    }
} catch (PDOException $e) {
    die("Querry Failed: " . $e->getMessage());
}