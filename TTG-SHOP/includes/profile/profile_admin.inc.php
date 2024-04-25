<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {

        require_once '../dbh.inc.php';
        require_once 'profile_admin_model.inc.php';
        require_once 'profile_admin_contr.inc.php';

        if (isset($_POST['search_user'])) {

            $search = $_POST["search"];
            $results = search_users($pdo, $search);

            require_once '../config_session.inc.php';

            $_SESSION["users_list"] = $results;

            header("Location: /profile/admin/profile_admin_list_users.php?");

            $pdo = null;
            $stmt = null;

            die();
        }

        if (isset($_POST['edit_user_menu'])) {

            $userId = $_POST["user_id"];
            $username = $_POST["user_name"];
            $email = $_POST["user_email"];
            $group = $_POST["group_id"];

            $editData = [
                "user_id" => $userId,
                "user_name" => $username,
                "user_email" => $email,
                "user_group" => $group
            ];

            require_once '../config_session.inc.php';

            $_SESSION["edit_data"] = $editData;

            header("Location: /profile/admin/profile_admin_edit_acc.php");

            die();
        }

        if (isset($_POST['delete_user'])) {

            $userId = $_POST["user_id"];
            delete_user($pdo, $userId);

            header("Location: /profile/admin/profile_admin_list_users.php?deleting=success");

            $pdo = null;
            $stmt = null;

            die();
        }


        if (isset($_POST['acc_add'])) {

            $username = $_POST["username"];
            $pwd = $_POST["pwd"];
            $email = $_POST["email"];
            $group = $_POST['group'];

            //ERROR HANDLERS
            $errors = [];
            if (is_input_empty($username, $pwd, $email)) {
                $errors["empty_input"] = "Zapełnij wszystkie pola";
            }

            if (is_email_invalid($email)) {
                $errors["invalid_email"] = "Niepoprawny adres e-mail";
            }
            if (is_username_taken($pdo, $username)) {
                $errors["username_taken"] = "Podana nazwa użytkownika jest już zajęta";
            }
            if (is_email_taken($pdo, $email)) {
                $errors["email_taken"] = "Podany e-mail jest już zarejestrowany";
            }

            require_once '../config_session.inc.php';

            if ($errors) {

                $_SESSION["errors_adding_acc"] = $errors;

                $addingAccData = [
                    "username" => $username,
                    "email" => $email
                ];
                $_SESSION["adding_acc_data"] = $addingAccData;

                header("Location: /profile/admin/profile_admin_add_acc.php");


                die();
            }


            create_user($pdo, $username, $pwd, $email, $group);
            header("Location: /profile/admin/profile_admin_add_acc.php?adding=success");

            $pdo = null;
            $stmt = null;

            die();
        }

        if (isset($_POST['acc_edit'])) {

            $userId = $_POST["user_id"];
            $username = $_POST["username"];
            $oldname = $_POST["old_username"];
            $pwd = $_POST["pwd"];
            $email = $_POST["email"];
            $oldemail = $_POST["old_email"];
            $group = $_POST['group'];

            //ERROR HANDLERS
            $errors = [];

            if ($email != null && is_email_invalid($email)) {
                $errors["invalid_email"] = "Niepoprawny adres e-mail";
            }
            if ($username != null && is_username_taken($pdo, $username)) {
                $errors["username_taken"] = "Podana nazwa użytkownika jest już zajęta";
            }
            if ($email != null && is_email_taken($pdo, $email)) {
                $errors["email_taken"] = "Podany e-mail jest już zarejestrowany";
            }

            require_once '../config_session.inc.php';

            if ($errors) {
                $_SESSION["errors_adding_acc"] = $errors;
                $editData = [
                    "user_id" => $userId,
                    "user_name" => $oldname,
                    "user_email" => $oldemail,
                    "user_group" => $group
                ];
                $_SESSION["edit_data"] = $editData;

                header("Location: /profile/admin/profile_admin_edit_acc.php");

                die();
            }

            edit_user($pdo, $userId, $username, $pwd, $email, $group);


            header("Location: /profile/admin/profile_admin_list_users.php?editing=success");

            $pdo = null;
            $stmt = null;

            die();
        }

        header("Location: /profile/admin/profile_admin.php");
        die();
    } catch (PDOException $e) {
        die("Querry Failed: " . $e->getMessage());
    }
} else {
    header("Location: /profile/admin/profile_admin.php");
    die();
}
