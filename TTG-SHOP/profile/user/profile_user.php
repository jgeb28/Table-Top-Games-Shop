<?php
require_once '../../includes/config_session.inc.php';
require_once '../../includes/navbar/navbar_view.inc.php';

if(!isset($_SESSION["user_id"]) || $_SESSION["user_group_id"] != 1)
   header("Location: ../../index.php");
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/TTG-SHOP/style.css">
    </head>

    <body>
        
        <header class="navbar">
                    <ul>
                        <li class="logo"><a href="/TTG-SHOP/index.php">Planszówkowo</a></li>
                        <li class="search_box">
                            <input type="text" placeholder="Wyszukiwanie...">
                            <button type="submit"><img src="images/search_icon.svg"></button>
                        </li>
                        <div class="elements">
                            <li><a>Koszyk</a></li>
                            <?php go_to_profile() ?>
                            <li><a id = "menu">M</a></li>
                        </div>
                    </ul>
        </header>
        <main class="main">
            <div class="container-profile">
                <div class="profile-panel">
                    <h4>Historia Zakupów</h4>
                </div>
                <div class="profile-panel-menu">
                    <form action="/TTG-SHOP/includes/profile/logout.inc.php" method="post">
                        <button>Wyloguj</button>
                    </form>
                </div>
                
            </div>
        </main>
        <footer class="footer">
            <div class = "footer-row">
                <div class= "footer-col">
                    <h4>Zamówienia</h4>
                    <ul>
                        <li><a href="#">Reklamacja</a></li>
                        <li><a href="#">Zwrot</a></li>
                        <li><a href="#">Formy Dostawy</a></li>
                        <li><a href="#">Formy Płatności</a></li>
                    </ul>
                </div>
                <div class= "footer-col">
                    <h4>Konto</h4>
                    <ul>
                        <li><a href="/TTG-SHOP/sign_up.php">Zarejestruj się</a></li>
                        <li><a href="#">Koszyk</a></li>
                        <li><a href="#">Historia transakcji</a></li>
                    </ul>
                </div>
                <div class= "footer-col">
                    <h4>Regulaminy</h4>
                    <ul>
                        <li><a href="#">Informacja o sklepie</a></li>
                        <li><a href="#">Polityka prywatności</a></li>
                        <li><a href="#">Regulamin</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    
    </body>   
</html>