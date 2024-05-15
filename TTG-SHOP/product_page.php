<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/product/display_product_details.inc.php';
require_once 'includes/product/product_view.inc.php';
include_once "header.php";
?>
<main class="main">
    <div class="categories">
        <ul>
            <div class="elements">
                <li><a>Karciane</a></li>
                <li><a>Logiczne</a></li>
                <li><a>Przygodowe</a></li>
                <li><a>Rodzinne</a></li>
                <li><a>Strategiczne</a></li>
                <li><a>Imprezowe</a></li>
                <li><a id="accessories">Akcesoria</a></li>
            </div>
        </ul>
    <div>
    <?php display_product_details(); ?>
</main>
<?php include_once "footer.php"; ?>