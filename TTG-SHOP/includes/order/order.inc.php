<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    require_once '../dbh.inc.php';
    require_once 'order_model.inc.php';
    require_once 'order_contr.inc.php';


    if(isset($_POST['prepare_order'])) {

        $payment = $_POST['payment'];
        $shipping = $_POST['shipping'];

        $errors = [];

        if(is_input_empty($payment, $shipping)) {
            $errors['order-payment-shipping'] = "Nie wybrano metod płatności i/lub dostawy";
        }
        require_once '../config_session.inc.php';
        if($errors) {
            $_SESSION["order-payment-shipping-error"] = $errors;
            header("Location: /order.php?action=prepare");
            die();
        }

        $_SESSION["order_payment"] = $payment;
        $_SESSION["order_shipping"] = $shipping;

        header("Location: /order.php?action=order&&shipping=$shipping");
        die();
    }

    if(isset($_POST['make_order'])) {

        require_once '../config_session.inc.php';
        if(!isset($_SESSION["order_list"])) {
            $_SESSION['unexpected_error']['order_error'] = "Próbowano złożyć zamównienie bez produktów"; 
            header("Location: /unexpected_error.php");
        }

        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $shipping = $_SESSION["order_shipping"];

        $errors = [];

        if(is_input_empty($fullname, $email)) {
            $errors['making-order'] = "Nie wypełniono wymaganych pól";
        } else {
            if(is_email_invalid($email)) {
                $errors['invalid_email'] = "Email jest niepoprawny";
            }
            if(is_phone_invalid($phone)) {
                $errors['invalid_phone'] = "Podany numer telefonu jest niepoprawny";
            }
        }

        if($errors) {
            require_once '../config_session.inc.php';
            $_SESSION['making-order'] = $errors;
            header("Location: /order.php?action=order&&shipping=$shipping");
            die();
        }

        descrease_quantity($pdo);
        if(isset($_SESSION["unexpected_error"]["product_sold_out"])) {
            unset($_SESSION["order_list"]);
            unset($_SESSION["order_subtotal"]);
            unset($_SESSION["order_payment"]);
            unset($_SESSION["order_shipping"]);
            unset($_SESSION["cart"]);
            header("Location: /unexpected_error.php");
            die();
        }
        create_order($pdo, $fullname, $email, $phone);
        unset($_SESSION["cart"]);
        header("Location: /cart.php?ordering=success");
        die();
    }

} else {
    header("Location: /order.php");
    die();
}