<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/product/display_products_new.inc.php';
require_once 'includes/product/product_view.inc.php';
include_once "header.php";
?>
<main class="main">
    <div class="categories">
        <ul>
            <div class="elements">
                <li><a href="product_search.php?category=1">Karciane</a></li>
                <li><a href="product_search.php?category=2">Logiczne</a></li>
                <li><a href="product_search.php?category=3">Przygodowe</a></li>
                <li><a href="product_search.php?category=4">Rodzinne</a></li>
                <li><a href="product_search.php?category=5">Strategiczne</a></li>
                <li><a href="product_search.php?category=6">Imprezowe</a></li>
                <li><a href="product_search.php?category=7">Akcesoria</a></li>
            </div>
        </ul>
    <div>
    <div class="prod-section">
        <h4>Polecane</h4>
    </div>
    <div class="prod-section">
        <h4>Nowości</h4>
        <?php display_new_products(); ?>
    </div>
</main>
<?php include_once "footer.php"; ?>