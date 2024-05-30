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
                <h6><a href="/index.php">Strona Główna</a> -> <a href="product_search.php?category=' . $result["category_id"] . '">' . $result["category_name"] . '</a></h6>
                <span>' . $result["product_brand"] . '</span>
                <h3>' . $result["product_name"] . '</h3>
                <div class="price">
                    <h2>' . $result["product_price"] . ' zł</h2><span>/szt.</span>
                </div>';
                if( $result['product_quantity'] == 0) {
                    echo '
                    <input type="number" name="quantity" value="0" min="0" max="0">
                    <input type="hidden" name="productId" value="' . $result["product_id"] . '">
                    <button id="unavail" name="addtocart">Niedostępny</button>
                    ';
                }
                else {
                echo '
                <form action="includes/product/cart.inc.php" method="post">
                    <input type="number" name="quantity" value="1" min="1" max="99">
                    <input type="hidden" name="productId" value="' . $result["product_id"] . '">
                    <button type=submit" name="addToCart">Dodaj do koszyka</button>
                </form>
                ';
                }
                echo '
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

function display_searched_products() {
    if(isset($_SESSION["search"])) {

        $results = $_SESSION["search"];
        $uri = $_SERVER['REQUEST_URI'];

        $url_parts = parse_url($uri);
        parse_str($url_parts['query'] ?? '', $query_params);

        $alph_url = $url_parts['path'] . update_sort_param($query_params, 'alph'); 
        $pasc_url = $url_parts['path'] . update_sort_param($query_params, 'pasc');
        $pdesc_url = $url_parts['path'] . update_sort_param($query_params, 'pdesc');
        $new_url = $url_parts['path'] . update_sort_param($query_params, 'new');
        
        echo ' 
        <div class="product-sort">
            <ul>
                <li><h5>Sortuj według: </h5></li>
                <li><a href=' . $alph_url . '><span>alfabetycznie</span></a></li>
                <li><a href=' . $pasc_url . '><span>po cenie rosnąco</span></a></li>
                <li><a href=' . $pdesc_url . '><span>po cenie malejąco</span></a></li>
                <li><a href=' . $new_url . '><span>od najnowszych</span></a></li>
            </ul>
        </div>
        <div class="prod-container">
        ';
        foreach($results as $result) {
                $htmlImage = substr($result["image_destination"], 13);
            echo '
                <div class="prod">
                    <a href=product_page.php?product=' . $result["product_id"] . '><img src="' . $htmlImage . '" alt=""></a>
                    <div class="prod-desc">
                        <span>' . $result["product_brand"] . '</span>
                        <h3>' . $result["product_name"] . '</h3>
                        <h5>' . $result["product_price"] . ' zł/ szt.</h5>
                ';
            if( $result['product_quantity'] == 0) {
                echo '
                <input type="hidden" name="quantity" value="0" min="0" max="0">
                <input type="hidden" name="productId" value="' . $result["product_id"] . '">
                <button id="unavail" name="addtocart">Niedostępny</button>
                ';
            }
            else {
            echo '
            <form action="includes/product/cart.inc.php" method="post">
                <input type="hidden" name="quantity" value="1" min="1" max="99">
                <input type="hidden" name="productId" value="' . $result["product_id"] . '">
                <button type=submit" name="addToCart">Dodaj do koszyka</button>
            </form>
            ';
            }
            echo '
                    </div>
                </div>
            ';
        }
        echo '</div>';
        unset($_SESSION["search"]);
    }
}

function display_new_products() {
    if(isset($_SESSION["new_products"])) {

        $results = $_SESSION["new_products"];
        
        echo ' 
        <div class="prod-container">
        ';
        foreach($results as $result) {
                $htmlImage = substr($result["image_destination"], 13);
            echo '
                <div class="prod">
                    <a href=product_page.php?product=' . $result["product_id"] . '><img src="' . $htmlImage . '" alt=""></a>
                    <div class="prod-desc">
                        <span>' . $result["product_brand"] . '</span>
                        <h3>' . $result["product_name"] . '</h3>
                        <h5>' . $result["product_price"] . ' zł/ szt.</h5>
                ';
                if( $result['product_quantity'] == 0) {
                    echo '
                    <input type="hidden" name="quantity" value="0" min="0" max="0">
                    <input type="hidden" name="productId" value="' . $result["product_id"] . '">
                    <button id="unavail" name="addtocart">Niedostępny</button>
                    ';
                }
                else {
                echo '
                <form action="includes/product/cart.inc.php" method="post">
                    <input type="hidden" name="quantity" value="1" min="1" max="99">
                    <input type="hidden" name="productId" value="' . $result["product_id"] . '">
                    <button type=submit" name="addToCart">Dodaj do koszyka</button>
                </form>
                ';
                }
                echo '
                        </div>
                    </div>
                ';
        }
        echo '</div>';
        unset($_SESSION["new_products"]);
    }
}

function update_sort_param($params, $new_sort) {
    $params['sort'] = $new_sort; 
    return '?' . http_build_query($params); 
}
