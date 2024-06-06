<?php
function get_product_data(object $pdo, int $productId) {
    $query = "SELECT products.product_name,
    products.product_id, products.product_price, products.product_quantity , products.product_description,
    categories.category_id, products.product_brand, products.product_age_class, products.product_players_min,
    products.product_players_max, products.product_language
    FROM products
    JOIN categories ON products.category_id = categories.category_id
    WHERE product_id = :product_id;";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    $stmt->bindParam(":product_id", $productId);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch using name of the column

    return $result;
}
function get_images_data(object $pdo, int $productId) {
    $query = "SELECT images.image_destination
    FROM images
    JOIN products_images ON images.image_id = products_images.image_id
    WHERE products_images.product_id = :product_id;";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    $stmt->bindParam(":product_id", $productId);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    return $result;
}
function edit_product(
    object $pdo,
    int $productId,
    string $product,
    float $price,
    string $description,
    int $quantity,
    int $category,
    string $brand,
    ?string $ageClass,
    ?string $playersMin,
    ?string $playersMax,
    ?string $language
) {

    $query = "UPDATE products SET product_name = :product_name, 
    product_price = :product_price,
    product_quantity = :product_quantity, 
    product_description = :product_description,
    category_id = :category_id, 
    product_brand = :product_brand"; 

    if($ageClass != null) {
        $query .= ", product_age_class = :product_age_class"; 
    }
    if($playersMin != null && $playersMax != null) {
        $query .= ", product_players_min = :product_players_min, 
                    product_players_max = :product_players_max"; 
    }
    if($language != null) {
        $query .= ", product_language = :product_language"; 
    }

    $query .= " WHERE product_id = :product_id"; 

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":product_id", $productId);
    $stmt->bindParam(":product_name", $product);
    $stmt->bindParam(":product_price", $price);
    $stmt->bindParam(":product_description", $description);
    $stmt->bindParam(":product_quantity", $quantity);
    $stmt->bindParam(":category_id", $category);
    $stmt->bindParam(":product_brand", $brand);
    if($ageClass != null) {
        $stmt->bindParam(":product_age_class", $ageClass);
    }
    if($playersMin != null && $playersMax != null) {
        $stmt->bindParam(":product_players_min", $playersMin);
        $stmt->bindParam(":product_players_max", $playersMax);
    }
    if($language != null) {
        $stmt->bindParam(":product_language", $language);
    }

    $stmt->execute();  

}
function delete_product(object $pdo, string $productId)
{
    $result_images = delete_image($pdo, $productId);

    $query = "DELETE FROM products WHERE product_id = :product_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":product_id", $productId);
    $stmt->execute();

    return $result_images;
}

function delete_image(object $pdo, string $productId) {
    $query = "SELECT images.image_destination
    FROM images
    JOIN products_images ON images.image_id = products_images.image_id
    WHERE products_images.product_id = :product_id;";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    $stmt->bindParam(":product_id", $productId);
    $stmt->execute();

    $result_images = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    $query = "DELETE FROM products_images WHERE product_id = :product_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":product_id", $productId);
    $stmt->execute();

    $query = "DELETE FROM images
     WHERE image_id NOT IN (
     SELECT image_id
     FROM products_images
     );";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $result_images;
}

function get_productname(object $pdo, string $product)
{

    $query = "SELECT product_name FROM products WHERE product_name = :product_name;";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    $stmt->bindParam(":product_name", $product);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch using name of the column

    return $result;
}

function  create_product(
    object $pdo,
    string $product,
    float $price,
    string $description,
    int $quantity,
    int $category,
    string $brand,
    string $iconNewName,
    string $imageNewName,
    string $iconDestination,
    string $imageDestination,
    ?string $ageClass,
    ?string $playersMin,
    ?string $playersMax,
    ?string $language,
) {

    $query = "INSERT INTO products (product_name, product_price, product_description, category_id, product_quantity, product_brand";
    if($ageClass != null) {
        $query = $query . ", product_age_class";
    }
    if($playersMin != null && $playersMax != null) {
        $query = $query . ", product_players_min, product_players_max";
    }
    if($language != null) {
        $query = $query . ", product_language";
    }
    $query = $query . ")";
    $queryValues = " 
    VALUES (:product_name, :product_price, :product_description, :category_id, :product_quantity, :product_brand ";
    if($ageClass != null) {
        $queryValues = $queryValues . ", :product_age_class";
    }
    if($playersMin != null && $playersMax != null) {
        $queryValues = $queryValues . ", :product_players_min, :product_players_max";
    }
    if($language != null) {
        $queryValues = $queryValues . ", :product_language";
    }
    $queryValues = $queryValues . ");";
    $queryImage = "
    SET @product_id = LAST_INSERT_ID();
    INSERT INTO images (image_name, image_destination, image_type)
    VALUES (:image_name, :image_destination, 'big');
    SET @image_id = LAST_INSERT_ID();
    INSERT INTO images (image_name, image_destination, image_type)
    VALUES (:icon_name, :icon_destination, 'small');
    SET @icon_id = LAST_INSERT_ID();
    INSERT INTO products_images (product_id, image_id) VALUES (@product_id, @image_id), (@product_id, @icon_id);";
    $wholeQuery = $query . $queryValues . $queryImage;
    $stmt = $pdo->prepare($wholeQuery);


    $stmt->bindParam(":product_name", $product);
    $stmt->bindParam(":product_price", $price);
    $stmt->bindParam(":product_description", $description);
    $stmt->bindParam(":product_quantity", $quantity);
    $stmt->bindParam(":category_id", $category);
    $stmt->bindParam(":product_brand", $brand);
    if($ageClass != null) {
        $stmt->bindParam(":product_age_class", $ageClass);
    }
    if($playersMin != null && $playersMax != null) {
        $stmt->bindParam(":product_players_min", $playersMin);
        $stmt->bindParam(":product_players_max", $playersMax);
    }
    if($language != null) {
        $stmt->bindParam(":product_language", $language);
    }

    $stmt->bindParam(":image_name", $imageNewName);
    $stmt->bindParam(":image_destination", $imageDestination);
    $stmt->bindParam(":icon_name", $iconNewName);
    $stmt->bindParam(":icon_destination", $iconDestination);

    $stmt->execute();
}

function get_products(object $pdo)
{
    $query = "SELECT products.product_name,
    products.product_id, products.product_price, products.product_quantity,
    products.product_brand, products.category_id, categories.category_name
    FROM products
    JOIN categories ON products.category_id = categories.category_id;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function search_products(object $pdo, string $search)
{
    $query = "SELECT products.product_name,
    products.product_id, products.product_price, products.product_quantity , products.category_id,
    categories.category_name
    FROM products
    JOIN categories ON products.category_id = categories.category_id
    WHERE products.product_name LIKE :search;";
    $stmt = $pdo->prepare($query);
    $searchParam = "%$search%";
    $stmt->bindParam(':search', $searchParam);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function change_image(object $pdo,int $productId,string $iconNewName,string $imageNewName, string $iconDestination,string $imageDestination) {
    $result_images = delete_image($pdo, $productId);

    
    $query = "INSERT INTO images (image_name, image_destination, image_type)
    VALUES (:image_name, :image_destination, 'big');
    SET @image_id = LAST_INSERT_ID();
    INSERT INTO images (image_name, image_destination, image_type)
    VALUES (:icon_name, :icon_destination, 'small');
    SET @icon_id = LAST_INSERT_ID();
    INSERT INTO products_images (product_id, image_id) VALUES (:product_id, @image_id), (:product_id, @icon_id);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":product_id", $productId);
    $stmt->bindParam(":image_name", $imageNewName);
    $stmt->bindParam(":image_destination", $imageDestination);
    $stmt->bindParam(":icon_name", $iconNewName);
    $stmt->bindParam(":icon_destination", $iconDestination);

    $stmt->execute();

    return $result_images;
}

function get_orders($pdo) {
    
    $query = "SELECT order_id, order_email, order_payment, order_shipping, order_date, order_status
    FROM orders";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function delete_order(object $pdo, string $orderId)
{
    $query = "DELETE FROM orders WHERE order_id = :order_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":order_id", $orderId);
    $stmt->execute();
}

function change_order_status(object $pdo, string $orderId, string $status)
{
    $query = "UPDATE ORDERS SET order_status = :order_status WHERE order_id = :order_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":order_id", $orderId);
    $stmt->bindParam(":order_status", $status);
    $stmt->execute();
}

function get_order(object $pdo, int $orderId) {
    $query = "SELECT *
    FROM orders
    WHERE orders.order_id = :order_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':order_id', $orderId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}