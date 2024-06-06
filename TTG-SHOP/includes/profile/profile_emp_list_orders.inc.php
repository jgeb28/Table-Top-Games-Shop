<?php
try {
    require_once '../../includes/dbh.inc.php';
    require_once 'profile_emp_model.inc.php';

    if (!isset($_SESSION["orders_list"])) {
        $result = get_orders($pdo);
        $_SESSION["orders_list"] = $result;
    }
} catch (PDOException $e) {
    die("Querry Failed: " . $e->getMessage());
}
