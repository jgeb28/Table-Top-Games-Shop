<?php
declare(strict_types=1);

function display_product_details() {
    if(isset($_SESSION["product_data"]) && isset($_SESSION["product_images"])) {
        $result = $_SESSION["product_data"];
        $resultImages = $_SESSION["product_images"];
        $htmlImage = substr($resultImages[0]["image_destination"], 13);
        echo '
        <div class="product-details">
            <div class="single-prod-image">
                <img src="' . $htmlImage . '" alt="">
            </div>
            <div class="single-prod-details">
                <h6><a href="/index.php">Strona Główna</a> -> <a href="#">' . $result["category_name"] . '</a></h6>
                <span>' . $result["product_brand"] . '</span>
                <h3>' . $result["product_name"] . '</h3>
                <div class="price">
                    <h2>' . $result["product_price"] . ' zł</h2><span>/szt.</span>
                </div>
                <input type="number" name="quantity" value="1" min="1" max="99">
                <button type=submit" name="addtocart">Dodaj do koszyka</button>
                <h4>Opis Produktu</h4>
                <span>' . $result["product_description"] . '</span>
            </div>
        </div>
        <div class="product-specs">
            <div class="single-product-specs">
                <div class="label-specs">
                    <label for="category">Kategoria:</label>
                    <span name="category">' . $result["category_name"] . '</span>
                </div>
                <div class="label-specs">
                    <label for="brand">Marka:</label>
                    <span name="brand">' . $result["product_brand"] . '</span>
                </div>
                ';
                if(!is_null($result["product_age_class"])) {
                    echo '
                    <div class="label-specs">
                        <label for="age">Wiek gracza:</label>
                        <span name="age">' . $result["product_age_class"] . '+</span>
                    </div>
                    ';
                }
                if(!is_null($result["product_players_min"]) && !is_null($result["product_players_max"])) {
                    echo '
                    <div class="label-specs">
                        <label for="players">Ilosć graczy:</label>
                        <span name="players">' . $result["product_players_min"] . '-' . $result["product_players_max"] . '</span>
                    </div>
                    ';
                }
                if(!is_null($result["product_language"])) {
                    echo '
                    <div class="label-specs">
                        <label for="language">Wersja językowa:</label>
                        <span name="language">' . $result["product_language"] . '</span>
                    </div>
                    ';
                }
                echo '
            </div>
        </div>
        ';
        unset($_SESSION["products_data"]);
        unset($_SESSION["product_images"]);
    }
}