<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {

        require_once '../dbh.inc.php';
        require_once 'profile_emp_model.inc.php';
        require_once 'profile_emp_contr.inc.php';
        require_once '../config_session.inc.php';

        if (isset($_POST["prod_edit_submit"])) {
            $productId = $_POST["product_id"];
            $product = $_POST["product"];
            $price = $_POST["price"];
            $description = $_POST["description"];
            $category = $_POST["category"];
            $quantity = $_POST["quantity"];

            $icon = $_FILES['icon'];
            $iconName = $_FILES['icon']['name'];
            $iconError = $_FILES['icon']['error'];
            $iconSize = $_FILES['icon']['size'];

            $image = $_FILES['image'];
            $imageName = $_FILES['image']['name'];
            $imageError = $_FILES['image']['error'];
            $imageSize = $_FILES['image']['size'];

            //ERROR HANDLERS
            $errors = [];

            

            if(!is_input_empty_img($iconSize, $imageSize)) {
                if(only_one_image_added($iconSize, $imageSize)) {
                    $errors["wrong_img_input"] = "Należy dodać dwa obrazy";
                } else {
                    if (!empty($errorsfiles = file_errors($icon))) {
                        $errors = array_merge($errors, $errorsfiles);
                    }
                    if (!empty($errorsfiles = file_errors($image))) {
                        $errors = array_merge($errors, $errorsfiles);
                    }
                }
            }

            if (is_input_empty($product, $category, $price,  $description, $quantity)) {
                $errors["empty_input"] = "Zapełnij wszystkie pola";
            } else {
                if (is_productname_changed($pdo, $product, $productId) && does_product_exist($pdo, $product)) {
                    $errors["productname_wrong"] = "Podana nazwa produktu jest już zajęta";
                }
            }


            if ($errors) {
                $_SESSION["errors_adding_product"] = $errors;
                $result = get_product_data($pdo, $productId);
                $editData = [
                    "product_id" => $productId,
                    "product_name" =>  $result["product_name"],
                    "product_price" => $result["product_price"],
                    "product_quantity" => $result["product_quantity"],
                    "category_id" => $result["category_id"],
                    "product_description" => $result["product_description"],
                ];
    
                require_once '../config_session.inc.php';
    
                $_SESSION["edit_data"] = $editData;
                header("Location: /profile/employee/profile_employee_edit_prod.php");
                die();
            }

            edit_product(
                $pdo,
                $productId,
                $product,
                $price,
                $description,
                $quantity,
                $category,
            );

            

            if(!is_input_empty_img($iconSize, $imageSize)) {

                $root_folder = $_SERVER['DOCUMENT_ROOT'];

                $iconNewName = fileNewName($icon);
                $iconTmpName = $icon['tmp_name'];
                $iconDestination =  $root_folder . '/images/products/small/' . $iconNewName;
    
                $imageNewName = fileNewName($image);
                $imageTmpName = $image['tmp_name'];
                $imageDestination =  $root_folder . '/images/products/big/' . $imageNewName;

                move_uploaded_file($iconTmpName, $iconDestination);
                move_uploaded_file($imageTmpName, $imageDestination);
                $result = change_image($pdo, $productId, 
                strval($iconNewName),
                strval($imageNewName),
                strval($iconDestination),
                strval($imageDestination));

                foreach ($result as $image) {
                    unlink($image['image_destination']);
                }
    
            }

            header("Location: /profile/employee/profile_emp_list_products.php?editing=success");

            $pdo = null;
            $stmt = null;

            die();
        }

        if (isset($_POST['edit_product_menu'])) {

            $productId = $_POST["product_id"];
            $result = get_product_data($pdo, $productId);
            $editData = [
                "product_id" => $productId,
                "product_name" =>  $result["product_name"],
                "product_price" => $result["product_price"],
                "product_quantity" => $result["product_quantity"],
                "category_id" => $result["category_id"],
                "product_description" => $result["product_description"],
            ];

            $_SESSION["edit_data"] = $editData;

            header("Location: /profile/employee/profile_employee_edit_prod.php");

            die();
        }

        if (isset($_POST['delete_product'])) {

            $productId = $_POST["product_id"];
            $result = delete_product($pdo, $productId);
            foreach ($result as $image) {
                unlink($image['image_destination']);
            }

            header("Location: /profile/employee/profile_emp_list_products.php?deleting=success");

            $pdo = null;
            $stmt = null;

            die();
        }

        if (isset($_POST['search_products'])) {

            $search = $_POST["search"];
            $results = search_products($pdo, $search);

            require_once '../config_session.inc.php';

            $_SESSION["products_list"] = $results;
           
            header("Location: /profile/employee/profile_emp_list_products.php?");

            $pdo = null;
            $stmt = null;

            die();
        }

        if (isset($_POST['prod_submit'])) {
            $product = $_POST["product"];
            $price = $_POST["price"];
            $description = $_POST["description"];
            $category = $_POST["category"];
            $quantity = $_POST["quantity"];

            $icon = $_FILES['icon'];
            $iconName = $_FILES['icon']['name'];
            $iconError = $_FILES['icon']['error'];
            $iconSize = $_FILES['icon']['size'];

            $image = $_FILES['image'];
            $imageName = $_FILES['image']['name'];
            $imageError = $_FILES['image']['error'];
            $imageSize = $_FILES['image']['size'];

            //ERROR HANDLERS
            $errors = [];

            if (is_input_empty($product, $category, $price,  $description, $quantity) && is_input_empty_img($iconSize, $imageSize)) {
                $errors["empty_input"] = "Zapełnij wszystkie pola";
            } else {

                if (!empty($errorsfiles = file_errors($icon))) {
                    $errors = array_merge($errors, $errorsfiles);
                }
                if (!empty($errorsfiles = file_errors($image))) {
                    $errors = array_merge($errors, $errorsfiles);
                }

                if (does_product_exist($pdo, $product)) {
                    $errors["productname_wrong"] = "Podana nazwa produktu jest już zajęta";
                }
            }


            if ($errors) {
                $_SESSION["errors_adding_product"] = $errors;
                header("Location: /profile/employee/profile_employee_add_prod.php");
                die();
            }

            $root_folder = $_SERVER['DOCUMENT_ROOT'];

            $iconNewName = fileNewName($icon);
            $iconTmpName = $icon['tmp_name'];
            $iconDestination =  $root_folder . '/images/products/small/' . $iconNewName;

            $imageNewName = fileNewName($image);
            $imageTmpName = $image['tmp_name'];
            $imageDestination =  $root_folder . '/images/products/big/' . $imageNewName;

            move_uploaded_file($iconTmpName, $iconDestination);
            move_uploaded_file($imageTmpName, $imageDestination);

            create_product(
                $pdo,
                $product,
                $price,
                $description,
                $quantity,
                $category,
                strval($iconNewName),
                strval($imageNewName),
                strval($iconDestination),
                strval($imageDestination)
            );

            header("Location: /profile/employee/profile_employee_add_prod.php?addingprod=success");

            $pdo = null;
            $stmt = null;

            die();
        }
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: profile/employee/profile_employee_add_prod.php");
    die();
}

function fileNewName(array $file)
{
    $fileName = $file['name'];
    $filePreExt = explode('.', $fileName);
    $fileExt = strtolower((end($filePreExt)));

    $fileNewName = uniqid('', true) . "." . $fileExt;

    return $fileNewName;
}
