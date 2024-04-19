<?php
require_once '../../includes/config_session.inc.php';
if(!isset($_SESSION["user_id"]) || $_SESSION["user_group_id"] != 3)
    header("Location: ../../index.php");

require_once "../../includes/profile/profile_admin_view.inc.php";
require_once "../../includes/dbh.inc.php";
require_once "../../includes/profile/profile_admin_list_users.inc.php";
include_once "../../header.php";
?>
        <main class="main">
            <div class="container-profile">
                <div class="profile-panel">
                    <div class="list-wrapper">
                        <div class="list-search-box">
                            <form action="/includes/profile/profile_admin.inc.php" method="post">
                            <div class="search_box">
                                <input type="text" name="search" placeholder="Wyszukiwanie Kont...">
                                <button name="search_user" id="search_box_button" type="submit"><img src="/images/search_icon.svg"></button>
                            </div>
                            </form>
                        </div>
                        <table>
                            <tr id="tr-th">
                                <th>User_ID</th>
                                <th>User_Name</th>
                                <th>User_Group</th>
                                <th>User_E-mail</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php display_users();?>
                        </table>
                    </div>
                    <?php display_success();?>
                </div>
                <div class="profile-panel-menu">
                    <ul>
                        <li><a href="profile_admin_add_acc.php"><button>Utwórz konto</button></a></li>
                        <li><a href="profile_admin_list_users.php"><button>Wyświetl użytkowników</button></a></li>
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