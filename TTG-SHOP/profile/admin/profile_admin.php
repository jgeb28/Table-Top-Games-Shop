<?php
include_once "../../header.php";

if(!isset($_SESSION["user_id"]) || $_SESSION["user_group_id"] != 3)
    header("../../Location: index.php");
?>

        <main class="main">
            <div class="container-profile">
                <div class="profile-panel"></div>
                <div class="profile-panel-menu">
                    <ul>
                        <li><a href="profile_admin_add_acc.php"><button>Utwórz konto</button></a></li>
                        <li><a href="profile_admin_list_users.php"><button>Wyświetl użytkowników</button></a></li>
                        <li>
                            <form action="/TTG-SHOP/includes/profile/logout.inc.php" method="post">
                            <button>Wyloguj</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
<?php include_once "../../footer.php"; ?>