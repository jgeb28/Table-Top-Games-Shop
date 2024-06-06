<?php

declare(strict_types=1);

function create_order(object $pdo,string $fullname,string $email,?string $phone) {

    //Serialising order
    $jsonString = json_encode($_SESSION['order_list']);



    $userId = null;
    if(isset($_SESSION["user_group_id"]) && isset($_SESSION['user_id']) && $_SESSION["user_group_id"] != 1) {
        $userId = $_SESSION['user_id'];
    }

    $query = "INSERT INTO orders (order_fullname, order_email, order_date,
    order_status, user_id, order_payment, order_shipping, order_total_price, order_array";
    if($phone != null)  {
        $query = $query . ", order_phone";    
    }
    $query = $query . ")";

    $queryValues = "VALUES (:order_fullname, :order_email, CURDATE(),
        'Oczekujący', :user_id, :order_payment, :order_shipping, :order_total_price, :order_array";
    if($phone != null)  {
        $queryValues = $queryValues . ", :order_phone";    
    }
    $queryValues = $queryValues . ")";

    $query = $query . " " . $queryValues;

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":order_fullname", $fullname);
    $stmt->bindParam(":order_email", $email);
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":order_payment", $_SESSION['order_payment']);
    $stmt->bindParam(":order_shipping", $_SESSION['order_shipping']);
    $stmt->bindParam(":order_total_price", $_SESSION['order_subtotal']);
    $stmt->bindParam(":order_array", $jsonString);
    if ($phone != null) {
        $stmt->bindParam(":order_phone", $phone);
    }

    $stmt->execute();
}

function descrease_quantity($pdo) {
    $results = $_SESSION["order_list"];

    foreach( $results as $result) {
        $currentQuantity = get_quantity($pdo, $result["product_id"])["product_quantity"];
        $newQuantity = $currentQuantity - $result["product_quantity"];
        if($newQuantity < 0) {
            $_SESSION["unexpected_error"]["product_sold_out"] = "Produkt, który chciałeś kupić został właśnie sprzedany, brak wystarczejącej liczby towarów w magazynie, koszyk zostanie oczyszczony";
            break; 
        }
        $query = "UPDATE products SET product_quantity = :product_quantity
        WHERE product_id = :product_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":product_quantity", $newQuantity);
        $stmt->bindParam(":product_id", $result["product_id"]);
        $stmt->execute();
    }
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


