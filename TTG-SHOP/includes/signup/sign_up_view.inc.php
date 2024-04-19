<?php

declare(strict_types=1);

function sign_up_inputs() {
    if (isset($_SESSION["sign_up_data"]["email"]) && 
    !isset($_SESSION["errors_sign_up"]["email_taken"] )) {
        echo '<input type="email" name="email" placeholder="Email"
        value="' . $_SESSION["sign_up_data"]["email"] . '">';
    } else {
        echo '<input type="email" name="email" placeholder="Email">';
    }                

    if (isset($_SESSION["sign_up_data"]["username"]) && 
    !isset($_SESSION["errors_sign_up"]["username_taken"] )) {
        echo '<input type="text" name="username" placeholder="Nazwa Użytkownika"
        value="' . $_SESSION["sign_up_data"]["username"] . '">';
    } else {
        echo '<input type="text" name="username" placeholder="Nazwa Użytkownika">';
    }

    echo '<input type="password" name="pwd" placeholder="Hasło">';
}

function check_sign_up_errors() {
    if(isset($_SESSION["errors_sign_up"])) {
        $errors = $_SESSION["errors_sign_up"];

        echo "<br>";

        foreach($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION["errors_sign_up"]);
    } else if(isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br>';
        echo '<p class = "form-success">Zarejestrowano pomyślnie!</p>';
    }
}