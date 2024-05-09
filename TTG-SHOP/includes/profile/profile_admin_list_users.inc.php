<?php
try {
    require_once '../../includes/dbh.inc.php';
    require_once 'profile_admin_model.inc.php';

    if (!isset($_SESSION["users_list"])) {
        $result = get_users($pdo);
        $_SESSION["users_list"] = $result;
    }
} catch (PDOException $e) {
    die("Querry Failed: " . $e->getMessage());
}
