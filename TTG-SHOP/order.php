<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/order/order_view.inc.php';
if(!isset($_SESSION["order_list"]) || !isset($_SESSION["order_subtotal"])) {
    header("Location: /unexpected_error.php");
}
include_once "header.php";
?>
<main class="main">
    <?php display_action(); ?>
</main>
<?php include_once "footer.php"; ?>