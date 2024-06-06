<?php

declare(strict_types=1);

function display_order() {
    $results = $_SESSION["order_list"];

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

function check_order_adding_errors() {

   if(isset($_SESSION["order-payment-shipping-error"])) {
        $errors = $_SESSION["order-payment-shipping-error"];

        echo '<br>';

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION["order-payment-shipping-error"]);
   }
   else if(isset($_SESSION['making-order'])) {
    $errors = $_SESSION['making-order'];

    echo '<br>';

    foreach ($errors as $error) {
        echo '<p class="form-error">' . $error . '</p>';
    }

    unset($_SESSION['making-order']);
    }
}

function display_action() {
    if(isset($_GET["action"])) {
        if($_GET["action"] == "prepare") {
            echo '
            <form action="/includes/order/order.inc.php" method="POST">
            <div class="order-prepare-container">
                    <h4>Zamówienie</h4>
                    <table id="order-table">
                        <tr id="tr-th">
                            <th>Nazwa</th>
                            <th>Ilość</th>
                            <th>Cena</th>
                        </tr>
            ';
            display_order();
            echo '
                    </table>
                    <div class="subtotal-container">
                        <div class="subtotal">
                            <span class="text">Suma: </span>
            
                            <span class="price">' . $_SESSION["order_subtotal"] . ' PLN</span>
                        </div>
                    </div>
                    <h4>Dostawa</h4>
                    <table id="order-table">
                        <tr id="tr-th">
                            <th>Wybierz formę dostawy</th>
                            <th>Koszt</th>
                            <th>Wybór</th>
                        </tr>
                        <tr>
                            <td>Odbiór Osobisty</td>
                            <td>0 zł</td>
                            <td><input type="radio" checked value="inshop" name="shipping"></td>
                        </tr>
                    </table>
                    <table id="order-table">
                        <tr id="tr-th">
                            <th>Wybierz formę płatności</th>
                            <th>Koszt</th>
                            <th>Wybór</th>
                        </tr>
                        <tr>
                            <td>Płatność w sklepie</td>
                            <td>0 zł</td>
                            <td><input type="radio" checked value="inshop" name="payment"></td>
                        </tr>
                    </table>
                    <button id="button-site" type="submit" name="prepare_order">OK</button>
                    ';
            check_order_adding_errors();
            echo '
            </div>
            </form>
            ';
        }
        else if ($_GET["action"] == "order") {
                echo '
                <div class="order-detail-container">
                        <h4>Zamówienie</h4>
                        <table id="order-table">
                            <tr id="tr-th">
                                <th>Nazwa</th>
                                <th>Ilość</th>
                                <th>Cena</th>
                            </tr>
                ';
                display_order();
                echo '
                        </table>
                        <div class="subtotal-container">
                            <div class="subtotal">
                                <span class="text">Suma: </span>
                
                                <span class="price">' . $_SESSION["order_subtotal"] . ' PLN</span>
                            </div>
                        </div>
                </div>
                ';

                display_form();
        }
    }
}

function display_form() {
    if(isset($_GET['shipping'])) {
        if ($_GET['shipping'] == "inshop") {
            echo '
            <form action="/includes/order/order.inc.php" method="POST">
            <input type="hidden" name="shipping" value="inshop">
            <div class="form-container">
                <div class="wraper-container">
                    <div class="input-wraper">
                            <div class="label-input">
                                <label for="fullname">Imię i Nazwisko</label>
                                <input type="text" maxlength=300 name="fullname">
                            </div>
                            <div class="label-input">
                                <label for="email">E-mail:</label>
                                <input type="email" maxlength=100 name="email">
                            </div>
                            <div class="label-input">
                                <label for="phone">Numer Telefonu(Opcjonalne):</label>
                                <input type="tel" name="phone">
                            </div>
                    </div>
                </div>
                <button type="submit" id="button-site" name="make_order">Zamów</button>
            </div>
            </form>
            '
            ;
            check_order_adding_errors();
            display_success();
        }
    }
}


