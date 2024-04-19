<?php
require_once '../../includes/config_session.inc.php';

if(!isset($_SESSION["user_id"]) || $_SESSION["user_group_id"] != 1)
   header("Location: ../../index.php");

include_once "../../header.php";
?>

        <main class="main">
            <div class="container-profile">
                <div class="profile-panel">
                    <h4>Historia Zakupów</h4>
                </div>
                <div class="profile-panel-menu">
                    <form action="/includes/profile/logout.inc.php" method="post">
                        <button>Wyloguj</button>
                    </form>
                </div>
                
            </div>
        </main>
<?php include_once "../../footer.php";?>