<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {

        require_once '../dbh.inc.php';
        require_once 'profile_model.inc.php';
        require_once 'profile_contr.inc.php';
        require_once '../config_session.inc.php';

        if( isset($_POST['prod_submit'])) {
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

            if(is_input_empty($product, $category, $price,  $description, $quantity,  $icon, $image)) {
                $errors["empty_input"] = "Zapełnij wszystkie pola";
            } else {

                if(!empty($errorsfiles = file_errors($icon))) {
                    $errors = array_merge($errors, $errorsfiles);
                }
                if(!empty($errorsfiles = file_errors($image))) {
                    $errors = array_merge($errors, $errorsfiles);
                }

                if(does_product_exist($pdo, $product)) {
                    $errors["productname_wrong"] = "Podana nazwa produktu jest już zajęta";
                }
            }

           
            if ($errors) {
                $_SESSION["errors_adding_product"] = $errors;
                header("Location: profile/employee/profile_employee_add_prod.php");
                die();
            }

            $iconNewName = fileNewName($icon);
            $iconTmpName = $icon['tmp_name'];
            $iconDestination = '../../images/products/small/' . $iconNewName;
            $imageNewName = fileNewName($image);
            $imageTmpName = $image['tmp_name'];
            $imageDestination = '../../images/products/big/' . $imageNewName;

            move_uploaded_file($iconTmpName, $iconDestination);
            move_uploaded_file($imageTmpName, $imageDestination);

            create_product($pdo, $product, $price, $description, $quantity,  $category, strval($iconNewName), strval($imageNewName),
             strval($iconDestination), strval($imageDestination));

            header("Location: profile/employee/profile_employee_add_prod.php?addingprod=success");

            $pdo = null;
            $stmt = null;

            die();
        }

    } catch ( PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: profile/employee/profile_employee_add_prod.php");
    die();
} 

function fileNewName(array $file) {
    $fileName = $file['name'];
    $filePreExt = explode('.', $fileName);
    $fileExt = strtolower((end($filePreExt)));

    $fileNewName = uniqid('',true) . "." . $fileExt;

    return $fileNewName;
}