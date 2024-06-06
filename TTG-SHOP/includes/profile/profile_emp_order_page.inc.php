<?php
try {
    require_once '../../includes/dbh.inc.php';
    require_once 'profile_emp_model.inc.php';

    if (isset($_GET["order"])) {
        $orderId = $_GET["order"];
        $result = get_order($pdo, $orderId);
        $_SESSION["order_details"] = $result;
        $_SESSION["order_details"]["order_array"] = json_decode($_SESSION["order_details"]["order_array"], true);
    }
    else {
        header("Location: /profile/employee/profile_employee.php");
    }
} catch (PDOException $e) {
    die("Querry Failed: " . $e->getMessage());
}
