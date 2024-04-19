<?php
require_once '../../includes/config_session.inc.php';
require_once '../../includes/profile/profile_admin_view.inc.php';

if(!isset($_SESSION["user_id"]) || $_SESSION["user_group_id"] != 3)
    header("Location: /index.php");
include_once "../../header.php";
?>

        <main class="main">
            <div class="container-profile">
                <div id="profile-panel" class="profile-panel">
                        <h4>Edytowanie Konta</h4>
                            <form action="/includes/profile/profile_admin.inc.php" method="post">
                                <div class="input-wraper">    
                                    <?php adding_acc_edit_inputs() ?>
                                </div>
                                <button name="acc_edit" type="submit">Edytuj</button>
                            </form>
                        <?php check_adding_acc_errors() ?>
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