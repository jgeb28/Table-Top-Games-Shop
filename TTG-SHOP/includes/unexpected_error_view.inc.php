<?php

declare(strict_types=1);

function display_unexpected_error() {
    if(isset($_SESSION['unexpected_error'])) {
        $errors = $_SESSION['unexpected_error'];

        echo "<br>";

        foreach($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION["unexpected_error"]);
    }
}