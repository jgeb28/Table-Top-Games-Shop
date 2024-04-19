<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    try {
        require_once '../dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        //ERROR HANDLERS
        $errors = [];

        if(is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Zapełnij wszystkie pola";
        }

        $result = get_user($pdo, $username);

        if(does_username_exist($result)) {
            $errors["username_wrong"] = "Podana nazwa użytkownika nie istnieje";
        }

        if(!does_username_exist($result) && is_password_wrong($pwd, $result["user_pwd"])) {
            $errors["password_wrong"] = "Niepoprawne hasło"; 
        }


        require_once '../config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: /login.php");
            die();
        }
        session_destroy();
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["user_id"];
        session_id($sessionId);
        session_start();
        
        $_SESSION["user_id"] = $result["user_id"];
        $_SESSION["user_name"] = htmlspecialchars($result["user_name"]);
        $_SESSION["user_group_id"] = $result["group_id"];
        $_SESSION["last_regeneration"] = time();

        if($result["group_id"] == 3)
            header("Location: /profile/admin/profile_admin.php");
        else if($result["group_id"] == 2)
            header("Location: /profile/employee/profile_employee.php");
        else
            header("Location: /profile/user/profile_user.php");
        $pdo = null;
        $stmt = null;

        die();

    } catch ( PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }


} else {
    header("Location: /login.php");
    die();
}