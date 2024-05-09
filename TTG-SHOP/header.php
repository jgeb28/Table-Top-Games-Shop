<?php
require_once 'includes/navbar/navbar_view.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <script src="/script.js"></script>
</head>

<body>
    <header class="navbar">
        <ul>
            <li id="logo-big" class="logo"><a href="/index.php"><img src="/images/logo2.drawio.svg"></a></li>
            <li id="logo-small" class="logo"><a href="/index.php"><img src="/images/logo2.drawio.small.svg"></a></li>
            <li class="search_box">
                <input type="text" placeholder="Wyszukiwanie...">
                <button type="submit"><img src="/images/search_icon.svg"></button>
            </li>
            <div class="elements">
                <li><a><img src="/images/basket.svg"></a></li>
                <?php go_to_profile() ?>
                <li><a id="menu"><img src="/images/menu.svg"></a></li>
            </div>
        </ul>
    </header>