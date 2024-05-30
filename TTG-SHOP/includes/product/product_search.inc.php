<?php
    if(isset($_GET["sort"])) {
        $sort = null;
        if($_GET["sort"] == "alph"){
            $sort = "ORDER BY p.product_name ASC;";
        }
        elseif($_GET["sort"] == "pasc"){
            $sort = "ORDER BY p.product_price ASC;";
        }
        elseif($_GET["sort"] == "pdesc"){
            $sort = "ORDER BY p.product_price DESC;";
        }
        elseif($_GET["sort"] == "new"){
            $sort = "ORDER BY p.product_id DESC;";
        }
    } else {
        $sort = null;
    }
    
    if(isset($_GET["category"]) && isset($_GET["name"]) && $_GET["category"] != 8) {
        try {
            require_once 'includes/dbh.inc.php';
            require_once 'product_model.inc.php';
            $category = $_GET["category"];
            $name = $_GET["name"];
            $result = get_product_by_category_and_name($pdo, $category, $name, $sort);
            $_SESSION["search"] = $result;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
    
    else if(isset($_GET["name"])) {
        try {
            require_once 'includes/dbh.inc.php';
            require_once 'product_model.inc.php';
            $name= $_GET["name"];
            $result = get_product_by_name($pdo, $name, $sort);
            $_SESSION["search"] = $result;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    else if(isset($_GET["category"])) {
        try {
            require_once 'includes/dbh.inc.php';
            require_once 'product_model.inc.php';
            $category = $_GET["category"];
            $result = get_product_by_category($pdo, $category, $sort);
            $_SESSION["search"] = $result;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }