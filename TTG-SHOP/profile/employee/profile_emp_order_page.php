<?php
require_once '../../includes/config_session.inc.php';
if (!isset($_SESSION["user_id"]) || $_SESSION["user_group_id"] != 2)
    header("Location: ../../index.php");

require_once "../../includes/profile/profile_emp_view.inc.php";
require_once "../../includes/dbh.inc.php";
require_once "../../includes/profile/profile_emp_order_page.inc.php";
include_once "../../header.php";
?>
<main class="main">
    <?php display_order_details() ?>
</main>
<?php include_once "../../footer.php"; ?>