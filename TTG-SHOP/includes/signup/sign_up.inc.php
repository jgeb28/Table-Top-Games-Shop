<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {

        require_once '../dbh.inc.php';
        require_once 'sign_up_model.inc.php';
        require_once 'sign_up_contr.inc.php';
        
        //ERROR HANDLERS
        $errors = [];

        if(is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Zapełnij wszystkie pola";
        }
        if(is_email_invalid($email)) {
            $errors["invalid_email"] = "Niepoprawny adres e-mail";
        }
        if(is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Podana nazwa użytkownika jest już zajęta";
        }
        if(is_email_taken($pdo, $email)) {
            $errors["email_taken"] = "Podany e-mail jest już zarejestrowany";
        }

        require_once '../config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_sign_up"] = $errors;

            $signUpData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["sign_up_data"] = $signUpData;

            header("Location: ../../sign_up.php");
            die();
        }

        create_user($pdo, $username, $pwd, $email);

        header("Location: ../../sign_up.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Querry Failed: " . $e->getMessage());
    }

} else {
    header("Location: ../../sign_up.php");
    die();
}