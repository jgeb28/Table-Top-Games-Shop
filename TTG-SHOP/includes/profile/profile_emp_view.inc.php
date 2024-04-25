<?php

declare(strict_types=1);

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

function display_products() {
     if(isset($_SESSION["products_list"])) {
         $results = $_SESSION["products_list"];
         foreach($results as $result){
             $product_id = $result["product_id"];
             $product_name = $result["product_name"];
             $category_name = $result["category_name"];
             $category_id = $result["category_id"];
             $product_quantity = $result["product_quantity"];
             $product_price = $result["product_price"];
             echo '
             <tr>
             <form action="/includes/profile/profile_emp.inc.php" method="post">
             <input type="hidden"  name="product_id" value="' . $product_id . '">
             <input type="hidden"  name="product_name" value="' . $product_name . '">
             <input type="hidden"  name="category_name" value="' . $category_name . '">
             <input type="hidden"  name="category_id" value="' . $category_id . '">
             <input type="hidden"  name="product_quantity" value="' . $product_quantity . '">
             <input type="hidden"  name="product_price" value="' . $product_price . '">
             ';
             echo "
                 <td>$product_id</td>
                 <td>$product_name</td>
                 <td>$category_name</td>
                 <td>$product_quantity szt.</td>
                 <td>$product_price PLN</td>
             ";
             echo '
                 <td>
                     <button type="submit" name="edit_product_menu">Edytuj</button>
                 </td>
                 <td>
                     <button type="submit" name="delete_product">Usuń</button>
                 </td>
                 </form>
             </tr>
             ';   
         }
         unset($_SESSION["products_list"]);
     } 
 }

 function display_success() {
     if(isset($_GET["deleting"]) && $_GET["deleting"] === "success") {
         echo '<br>';
         echo '<p class = "form-success">Pomyślnie usunięto produkt!</p>';
     }
     if(isset($_GET["editing"]) && $_GET["editing"] === "success") {
         echo '<br>';
         echo '<p class = "form-success">Pomyślnie zedytowano produkt!</p>';
     }
 }
