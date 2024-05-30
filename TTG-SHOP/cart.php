<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/product/cart_prod_list.inc.php';
require_once 'includes/product/cart_view.inc.php';
include_once "header.php";
?>
<main class="main">
    <div class="container-cart">
        <h4>Koszyk</h4>
            <div class="cart-wrapper">
                <form action="/includes/product/cart.inc.php" method="POST">
                <table id="prod-table">
                    <tr id="tr-th">
                        <th></th>
                        <th>Nazwa</th>
                        <th>Ilość</th>
                        <th>Cena za szt.</th>
                        <th>Cena</th>
                        <th></th>
                    </tr>
                    <?php display_cart(); ?>
                </table>
                <div class="subtotal">
                    <span class="text">Suma: </span>
                    <span class="price"><?php echo $subtotal?> PLN</span>
                </div>
                <div class="cart-buttons">
                    <button type="submit" name="cart_update">Zaktualizuj</button>
                    <button type="submit" name="place_order">Złóż Zamówienie</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</main>
<?php include_once "footer.php"; ?>