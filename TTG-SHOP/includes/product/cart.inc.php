<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        require_once '../dbh.inc.php';
        require_once 'cart_model.inc.php';
        require_once 'cart_contr.inc.php';

        if(isset($_POST["addToCart"])) {
            $productId = $_POST["productId"];
            $quantity = $_POST["quantity"];

            $errors = [];

            if (!does_product_exist($pdo, $productId)) {
                $errors["product_dont_exists"] = "Podany produkt nie istnieje";
            }
            elseif (quantity_error($pdo, $productId, $quantity)) {
                $errors["quantity_error"] = "Nie ma wystarczającej ilości produktu";
            }
            
            

            require_once '../config_session.inc.php';

            if ($errors) {
                $_SESSION['unexpected_error'] = $errors;
                header("Location: /unexpected_error.php");
                die();
            }

            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                if (array_key_exists($productId, $_SESSION['cart'])) {

                    $_SESSION['cart'][$productId] += $quantity;
                } else {

                    $_SESSION['cart'][$productId] = $quantity;
                }
            } else {
                $_SESSION['cart'] = array($productId => $quantity);
            }

            header('Location: ' . $_SERVER['HTTP_REFERER']);

            $pdo = null;
            $stmt = null;
    
            die();
        }

        require_once '../config_session.inc.php';

        if(isset($_POST["cart_update"]) && isset($_SESSION['cart'])) {
   
            foreach ($_POST as $inp => $val) {
                if (strpos($inp, 'quantity') !== false && is_numeric($val)) {
                    $id = str_replace('quantity-', '', $inp);
                    $quantity = (int)$val;
                    
                    if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                        $_SESSION['cart'][$id] = $quantity;
                    }
                }
            }

            header('Location: /cart.php');

            $pdo = null;
            $stmt = null;
    
            die();
        }

        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: /index.php");
    die();
}
