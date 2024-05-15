<?php
require_once '../../includes/config_session.inc.php';
if (!isset($_SESSION["user_id"]) || $_SESSION["user_group_id"] != 2)
    header("Location: ../../index.php");

require_once "../../includes/profile/profile_emp_view.inc.php";
require_once "../../includes/dbh.inc.php";
require_once "../../includes/profile/profile_emp_list_products.inc.php";
include_once "../../header.php";
?>
<main class="main">
    <div class="container-profile">
        <div class="profile-panel">
            <div class="list-wrapper">
                <div class="list-search-box">
                    <form action="/includes/profile/profile_emp.inc.php" method="post">
                        <div class="search_box">
                            <input type="text" name="search" placeholder="Wyszukiwanie Prod...">
                            <button name="search_products" id="search_box_button" type="submit"><img src="/images/search_icon.svg"></button>
                        </div>
                    </form>
                </div>
                <table id="prod-table">
                    <tr id="tr-th">
                        <th onclick="sortTable('prod-table',0,this)">ID</th>
                        <th onclick="sortTable('prod-table',1,this)">Name</th>
                        <th onclick="sortTable('prod-table',2,this)">Cat</th>
                        <th onclick="sortTable('prod-table',3,this)">Qty</th>
                        <th onclick="sortTable('prod-table',4,this)">Price</th>
                        <th onclick="sortTable('prod-table',5,this)">Brand</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php display_products(); ?>
                </table>
            </div>
            <?php display_success(); ?>
        </div>
        <div class="profile-panel-menu">
            <ul>
                <li><a href="profile_emp_list_products.php"><button>Lista Produktów</button></a></li>
                <li><button>Lista Zamówień</button></li>
                <li><a href="profile_employee_add_prod.php"><button>Dodaj Produkt</button></a></li>
                <li>
                    <form action="/includes/profile/logout.inc.php" method="post">
                        <button>Wyloguj</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</main>
<?php include_once "../../footer.php"; ?>