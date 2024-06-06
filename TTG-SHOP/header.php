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
    <form action="product_search.php" method="get">
        <ul>
            <li id="logo-big" class="logo"><a href="/index.php"><img src="/images/logobig.png"></a></li>
            <li id="logo-small" class="logo"><a href="/index.php"><img src="/images/logo2.drawio.small.svg"></a></li>
            <li class="search_box">
                <input type="text" name="name" placeholder="Wyszukiwanie w ...">
                <select name="category">
                            <option value="1">karciane</option>
                            <option value="2">logiczne</option>
                            <option value="3">przygodowe</option>
                            <option value="4">rodzinne</option>
                            <option value="5">strategiczne</option>
                            <option value="6">imprezowe</option>
                            <option value="7">akcesoria</option>
                            <option selected value="8">dowolne</option>
                </select>
                <button type="submit"><img src="/images/search_icon.svg"></button>
            </li>
            <div class="elements">
                <li>
                    <div class="cart-container">
                        <div class="cart-icon">
                        <a href="/cart.php">
                            <img src="/images/basket.svg">
                            <span class="cart-count"><?php cart_quantity() ?></span>
                        </a>
                        </div>
                    </div>   
                </li>
                <?php go_to_profile() ?>
                <li><a id="menu"><img src="/images/menu.svg"></a></li>
            </div>
        </ul>
        </form>
    </header>