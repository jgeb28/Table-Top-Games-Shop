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

function adding_prod_edit_inputs() {

    if (isset($_SESSION["edit_data"])) {
        echo '
        <input type="hidden"  name="product_id" value="' . $_SESSION["edit_data"]["product_id"] . '">
        <div class="label-input">
            <label for="product">Nazwa Produktu:</label>
            <input maxlength=100 type="text" name="product" value="' . $_SESSION["edit_data"]["product_name"] . '">
        </div>
        <div class="label-input">
            <label for="brand">Marka Produktu:</label>
            <input maxlength=40 type="text" name="brand"value="' . $_SESSION["edit_data"]["product_brand"] . '">
        </div>
        <div class="label-input">
            <label for="category">Kategoria:</label>
            <select name="category">
                <option '; if($_SESSION["edit_data"]["category_id"] == 1 ){ echo 'selected';} echo' value="1">karciane</option>
                <option '; if($_SESSION["edit_data"]["category_id"] == 2 ){ echo 'selected';} echo' value="2">logiczne</option>
                <option '; if($_SESSION["edit_data"]["category_id"] == 3 ){ echo 'selected';} echo' value="3">przygodowe</option>
                <option '; if($_SESSION["edit_data"]["category_id"] == 4 ){ echo 'selected';} echo' value="4">rodzinne</option>
                <option '; if($_SESSION["edit_data"]["category_id"] == 5 ){ echo 'selected';} echo' value="5">strategiczne</option>
                <option '; if($_SESSION["edit_data"]["category_id"] == 6 ){ echo 'selected';} echo' value="6">imprezowe</option>
                <option '; if($_SESSION["edit_data"]["category_id"] == 7 ){ echo 'selected';} echo' value="7">akcesoria</option>
            </select>
        </div>
        <div class="label-input">
            <label for="icon">Miniaturka(290x270):</label>
            <input type="file" name="icon">
        </div>
        <div class="label-input">
            <label for="image">Szczegółowe zdjęcie(440x450):</label>
            <input type="file" name="image">
        </div>
        <p id="edit-paragraph">*dodaj dwa obrazy by zmienić</p>
        <div class="label-input">
            <label for="price">Cena produktu:</label>
            <input type="number" name="price" step="0.01" min="0" value="' . $_SESSION["edit_data"]["product_price"] . '">
        </div>
        <div class="label-input">
            <label for="ilość produktów">Ilość sztuk produktu:</label>
            <input type="number" name="quantity" min="0" value="' . $_SESSION["edit_data"]["product_quantity"] . '">
        </div>
        <div class="label-input">
            <label for="age_class">*Produkt dozwolony od lat:</label>
            <input class="number" type="number" name="age_class" min="1" value="' . $_SESSION["edit_data"]["product_age_class"] . '">
        </div>
        <div class="label-input">
            <label for="players_number">*Liczba graczy od:</label>
            <input class="number" type="number" name="players_min" min="1" value="' . $_SESSION["edit_data"]["product_players_min"] . '">
            <label>do:</label>
            <input class="number" type="number" name="players_max" min="1" value="' . $_SESSION["edit_data"]["product_players_max"] . '">
        </div>
        <div class="label-input">
            <label for="language">*Wersja Językowa:</label>
            <input type="text" name="language" value="' . $_SESSION["edit_data"]["product_language"] . '">
        </div>
        <div class="label-input">
            <span>* - Pola Opcjonalne</span>
        </div>
        <textarea name="description" rows=15 cols=50 maxlength=1000 placeholder="Opis">' . $_SESSION["edit_data"]["product_description"] . '</textarea>
        ';
        unset($_SESSION["edit_data"]);
    }
}

function display_products() {

     if(isset($_SESSION["products_list"])) {

         $results = $_SESSION["products_list"];
         foreach($results as $result){
             $product_id = $result["product_id"];
             $product_name = $result["product_name"];
             $category_name = $result["category_name"];
             $product_quantity = $result["product_quantity"];
             $product_price = $result["product_price"];
             $product_brand = $result["product_brand"];
             $product_page = "/product_page.php?product=$product_id";
             echo '
             <tr>
             <form action="/includes/profile/profile_emp.inc.php" method="post">
             <input type="hidden"  name="product_id" value="' . $product_id . '">
             ';
             echo "
                 <td>$product_id</td>
                 <td><a href="; echo'"';echo "$product_page"; echo'"'; echo">$product_name</a></td>
                 <td>$category_name</td>
                 <td>$product_quantity szt.</td>
                 <td>$product_price PLN</td>
                 <td>$product_brand</td>
             ";
             echo '
                 <td>
                     <button class="list-button" type="submit" name="edit_product_menu">Edytuj</button>
                 </td>
                 <td>
                     <button class="list-button" type="submit" name="delete_product">Usuń</button>
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
