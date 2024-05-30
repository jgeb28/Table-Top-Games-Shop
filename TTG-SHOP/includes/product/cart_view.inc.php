<?php

function display_cart() {
    if(isset($_SESSION["cart_list"])) {

        $results = $_SESSION["cart_list"];
        foreach($results as $result){
            $product_id = $result["product_id"];
            $product_name = $result["product_name"];
            $product_quantity = $result["product_quantity"];
            $product_price = $result["product_price"];
            $product_page = "/product_page.php?product=$product_id";
            $htmlImage = substr($result["image_destination"], 13);
            $total_price = $product_price * $product_quantity;
            echo '
            <tr>
            <input type="hidden"  name="product_id" value="' . $product_id . '">
            ';
            echo '
                <td><img src="' . $htmlImage . '" alt=""></td>';
            echo "
                <td><a href="; echo'"';echo "$product_page"; echo'"'; echo">$product_name</a></td>
            ";
            echo '
                <td><input type="number" name="quantity-' . $product_id . '" min="1" max="99" value=' . $product_quantity . '> szt.</td>
            ';
            echo "
                <td>$product_price PLN</td>
            ";
            echo "
                <td>$total_price PLN</td>
            ";
            echo '
                <td>
                    <a class="del-button" href="cart.php?remove=' . $product_id . '">Usuń</a>
                </td>
            </tr>
            ';   
        }
        unset($_SESSION["cart_list"]);
    } 
}