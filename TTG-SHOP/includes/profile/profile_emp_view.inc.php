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
        echo '<p class = "form-success">Pomyślnie dodano produkt!</p>';
   }
}

function adding_prod_edit_inputs() {

    if (isset($_SESSION["edit_data"])) {
        echo '
        <input type="hidden"  name="product_id" value="' . $_SESSION["edit_data"]["product_id"] . '">
        <div class="label-input">
            <label for="product">*Nazwa Produktu:</label>
            <input maxlength=100 type="text" name="product" value="' . $_SESSION["edit_data"]["product_name"] . '">
        </div>
        <div class="label-input">
            <label for="brand">*Marka Produktu:</label>
            <input maxlength=40 type="text" name="brand"value="' . $_SESSION["edit_data"]["product_brand"] . '">
        </div>
        <div class="label-input">
            <label for="category">*Kategoria:</label>
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
            <label for="icon">Miniaturka(270x290):</label>
            <input type="file" name="icon">
        </div>
        <div class="label-input">
            <label for="image">Szczegółowe zdjęcie(440x450):</label>
            <input type="file" name="image">
        </div>
        <p id="edit-paragraph">!!dodaj dwa obrazy by zmienić</p>
        <div class="label-input">
            <label for="price">*Cena produktu:</label>
            <input type="number" name="price" step="0.01" min="0" value="' . $_SESSION["edit_data"]["product_price"] . '">
        </div>
        <div class="label-input">
            <label for="ilość produktów">*Ilość sztuk produktu:</label>
            <input type="number" name="quantity" min="0" value="' . $_SESSION["edit_data"]["product_quantity"] . '">
        </div>
        <div class="label-input">
            <label for="age_class">Produkt dozwolony od lat:</label>
            <input class="number" type="number" name="age_class" min="1" value="' . $_SESSION["edit_data"]["product_age_class"] . '">
        </div>
        <div class="label-input">
            <label for="players_number">Liczba graczy od:</label>
            <input class="number" type="number" name="players_min" min="1" value="' . $_SESSION["edit_data"]["product_players_min"] . '">
            <label>do:</label>
            <input class="number" type="number" name="players_max" min="1" value="' . $_SESSION["edit_data"]["product_players_max"] . '">
        </div>
        <div class="label-input">
            <label for="language">Wersja Językowa:</label>
            <input type="text" name="language" value="' . $_SESSION["edit_data"]["product_language"] . '">
        </div>
        <div class="label-input">
            <label>*Opis:</label>
            <span>* - Pola Wymagane</span>
        </div>
        
        <textarea name="description" rows=15 cols=50 maxlength=1000 placeholder="*Opis">' . $_SESSION["edit_data"]["product_description"] . '</textarea>
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

 function display_success_order() {
    
    if(isset($_GET["deleting"]) && $_GET["deleting"] === "success") {
        echo '<br>';
        echo '<p class = "form-success">Pomyślnie usunięto zamówienie!</p>';
    }
    if(isset($_GET["editing"]) && $_GET["editing"] === "success") {
        echo '<br>';
        echo '<p class = "form-success">Pomyślnie zmieniono status zamówienia!</p>';
    }
}

 function display_orders() {

    if(isset($_SESSION["orders_list"])) {

        $results = $_SESSION["orders_list"];
        foreach($results as $result){
            $order_id = $result["order_id"];
            $order_email = $result["order_email"];
            $order_payment = $result["order_payment"];
            $order_shipping = $result["order_shipping"];
            $order_date = $result["order_date"];
            $order_status = $result["order_status"];
            $order_page = "/profile/employee/profile_emp_order_page.php?order=$order_id";
            echo '
            <tr>
            <form action="/includes/profile/profile_emp.inc.php" method="post">
            <input type="hidden"  name="order_id" value="' . $order_id . '">
            ';
            echo "
                <td><a href=" . $order_page . ">$order_id</a></td>
                <td>$order_email</td>
                <td>$order_date</td>
                <td>$order_payment</td>
                <td>$order_shipping</td>
            ";
            echo '
                <td>
                <select name="status">
                    <option '; if($order_status == "Oczekujący" ){ echo 'selected';} echo' value="Oczekujący">Oczekujący</option>
                    <option '; if($order_status == "Opłacony" ){ echo 'selected';} echo' value="Opłacony">Opłacony</option>
                    <option '; if($order_status == "Zakończony" ){ echo 'selected';} echo' value="Zakończony">Zakończony</option>
                </select>
                </td>
            ';
            echo '
                <td>
                    <button class="list-button" type="submit" name="change_order_status">Zmień</button>
                </td>
                <td>
                    <button class="list-button" type="submit" name="delete_order">Usuń</button>
                </td>
                </form>
            </tr>
            ';   
        }
        unset($_SESSION["orders_list"]);
    } 
}

function display_order_details() {
    if(isset($_SESSION["order_details"])) {
        $result = $_SESSION["order_details"];
        echo '
        <div class="order-prepare-container">
                <h4>Zamówienie</h4>
                <table id="order-minimal-table">
                    <tr id="tr-th">
                        <th>Nazwa</th>
                        <th>Ilość</th>
                        <th>Cena</th>
                    </tr>
        ';
        display_order();
        echo '
                </table>
                <h4>Dane</h4>
                <div class="product-specs">
                    <div class="single-product-specs">
                        <div class="label-specs">
                            <label for="ID">ID:</label>
                            <span name="ID">' . $result["order_id"] . '</span>
                        </div>
                        <div class="label-specs">
                            <label for="fullname">Imię i nazwisko:</label>
                            <span name="fullname">' . $result["order_fullname"] . '</span>
                        </div>
                        <div class="label-specs">
                            <label for="date">Data:</label>
                            <span name="date">' . $result["order_date"] . '</span>
                        </div>
                        <div class="label-specs">
                            <label for="status">Status:</label>
                            <span name="status">' . $result["order_status"] . '</span>
                        </div>
                        <div class="label-specs">
                            <label for="shipping">Sposób Dostawy:</label>
                            <span name="shipping">' . $result["order_shipping"] . '</span>
                        </div>
                        <div class="label-specs">
                            <label for="payment">Sposób płatności:</label>
                            <span name="payment">' . $result["order_payment"] . '</span>
                        </div>
                        <div class="label-specs">
                            <label for="total">Pełna kwota:</label>
                            <span name="total">' . $result["order_total_price"] . ' zł</span>
                        </div>
                        ';
                        if(!is_null($result["order_phone"])) {
                            echo '
                            <div class="label-specs">
                                <label for="phone">Numer Telefonu:</label>
                                <span name="phone">' . $result["order_phone"] . '</span>
                            </div>
                            ';
                        }
                        echo '
                    </div>
                </div>
               
        '; 
        unset($_SESSION["order_details"]);
    }
}

function display_order() {
    $results = $_SESSION["order_details"]["order_array"];

    foreach( $results as $result) {
        echo '
        <tr>
            <td>' . $result["product_name"] . '</td>
            <td>' . $result["product_quantity"] . '</td>
            <td>' . $result["product_price"] . '</td>
        </tr>
        ';
    }

}
