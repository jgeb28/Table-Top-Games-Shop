<?php
require_once '../../includes/config_session.inc.php';
require_once '../../includes/profile/profile_view.inc.php';

if(!isset($_SESSION["user_id"]) || $_SESSION["user_group_id"] != 2)
    header("Location: ../../index.php");
include_once "../../header.php";
?>

        <main class="main">
            <div class="container-profile">
                <div id="profile-panel" class="profile-panel">
                    <h4>Dodaj Produkt</h4>
                    <form action="/includes/profile/profile.inc.php" method="post" enctype="multipart/form-data">
                        <div class="input-wraper">
                                <div class="label-input">
                                    <label for="product">Nazwa Produktu:</label>
                                    <input type="text" name="product">
                                </div>
                                <div class="label-input">
                                    <label for="category">Kategoria:</label>
                                    <select name="category">
                                        <option value="1">karciane</option>
                                        <option value="2">logiczne</option>
                                        <option value="3">przygodowe</option>
                                        <option value="4">rodzinne</option>
                                        <option value="5">strategiczne</option>
                                        <option value="6">imprezowe</option>
                                        <option value="7">akcesoria</option>
                                    </select>
                                </div>
                                <div class="label-input">
                                    <label for="icon">Miniaturka:</label>
                                    <input type="file" name="icon">
                                </div>
                                <div class="label-input">
                                    <label for="image">Szczegółowe zdjęcie:</label>
                                    <input type="file" name="image">
                                </div>
                                <div class="label-input">
                                    <label for="price">Cena produktu:</label>
                                    <input type="number" name="price" step="0.01" min="0">
                                </div>
                                <div class="label-input">
                                    <label for="ilość produktów">Ilość sztuk produktu:</label>
                                    <input type="number" name="quantity" min="1">
                                </div>
                                <textarea name="description" rows=15 cols=50 maxlength=500 placeholder="Opis"></textarea>
                        </div>
                        <button type="submit" name="prod_submit">Dodaj</button>
                    </form>
                    <?php check_product_adding_errors() ?>
                </div>
                <div class="profile-panel-menu">
                    <ul>
                        <li><button>Lista Produktów</button></li>
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