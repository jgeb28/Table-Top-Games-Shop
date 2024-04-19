<?php

declare(strict_types=1);
require_once 'profile_admin_contr.inc.php';

function check_product_adding_errors() {
   if(isset($_SESSION["errors_adding_product"])) {
        $errors = $_SESSION["errors_adding_product"];

        echo '<br>';

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION["errors_adding_product"]);
   } else if(isset($_GET["addingprod"]) && $_GET["addingprod"] === "success") {
        echo '<br>';
        echo '<p class = "form-success">Dodano Produkt pomyślnie!</p>';
   }
}
