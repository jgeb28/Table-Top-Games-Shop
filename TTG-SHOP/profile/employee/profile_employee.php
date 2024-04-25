<?php
require_once '../../includes/config_session.inc.php';
require_once '../../includes/profile/profile_emp_view.inc.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_group_id"] != 2)
    header("Location: ../../index.php");
include_once "../../header.php";
?>

<main class="main">
    <div class="container-profile">
        <div id="profile-panel" class="profile-panel">
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