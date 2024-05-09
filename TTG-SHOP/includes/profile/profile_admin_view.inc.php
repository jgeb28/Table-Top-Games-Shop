<?php

declare(strict_types=1);

function adding_acc_inputs() {
    if (isset($_SESSION["adding_acc_data"]["email"]) && 
    !isset($_SESSION["errors_adding_acc"]["email_taken"] )) {
        echo '
        <div class="label-input">
            <label for="email">E-mail:</label>
            <input type="email" name="email" placeholder="Email" value="' . $_SESSION["adding_acc_data"]["email"] . '">
        </div>
        ';
    } else {
        echo '
        <div class="label-input">
            <label for="email">E-mail:</label>
            <input type="email" name="email" placeholder="Email">
        </div>
        ';
    }                

    if (isset($_SESSION["adding_acc_data"]["username"]) && 
    !isset($_SESSION["errors_adding_acc"]["username_taken"] )) {
        echo '
        <div class="label-input">
            <label for="username">Nazwa:</label>
            <input type="text" name="username" placeholder="Nazwa Użytkownika"
            value="' . $_SESSION["adding_acc_data"]["username"] . '">
        </div>    
        ';
    } else {
        echo '
        <div class="label-input">
            <label for="username">Nazwa:</label>
            <input type="text" name="username" placeholder="Nazwa Użytkownika">
        </div>    
        ';
    }
    echo '
        <div class="label-input">
            <label for="pwd">Hasło:</label>
            <input type="password" name="pwd" placeholder="Hasło">
        </div>    
    ';
    echo '
    <div class="label-input">
        <label for="group">Grupa:</label>
        <select name="group">
            <option value="1">Użytkownik</option>
            <option value="2">Pracownik</option>
            <option value="3">Administrator</option>
        </select>
    </div>
    ';
}

function check_adding_acc_errors() {
    if(isset($_SESSION["errors_adding_acc"])) {
        $errors = $_SESSION["errors_adding_acc"];

        echo "<br>";

        foreach($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION["errors_adding_acc"]);
    } else if(isset($_GET["adding"]) && $_GET["adding"] === "success") {
        echo '<br>';
        echo '<p class = "form-success">Pomyślnie dodano konto!</p>';
    }
}

function display_users() {
    if(isset($_SESSION["users_list"])) {
        $results = $_SESSION["users_list"];
        foreach($results as $result){
            $user_id = $result["user_id"];
            $user_name = $result["user_name"];
            $group_name = $result["group_name"];
            $user_email = $result["user_email"];
            echo '
            <tr>
            <form action="/includes/profile/profile_admin.inc.php" method="post">
            <input type="hidden"  name="user_id" value="' . $user_id . '">
            ';
            echo "
                <td>$user_id</td>
                <td>$user_name</td>
                <td>$group_name</td>
                <td>$user_email</td>
            ";
            echo '
                <td>
                    <button class="list-button" type="submit" name="edit_user_menu">Edytuj</button>
                </td>
                <td>
                    <button class="list-button" type="submit" name="delete_user">Usuń</button>
                </td>
                </form>
            </tr>
            ';   
        }
        unset($_SESSION["users_list"]);
    } 
}

function display_success() {
    if(isset($_GET["deleting"]) && $_GET["deleting"] === "success") {
        echo '<br>';
        echo '<p class = "form-success">Pomyślnie usunięto użytkownika!</p>';
    }
    if(isset($_GET["editing"]) && $_GET["editing"] === "success") {
        echo '<br>';
        echo '<p class = "form-success">Pomyślnie zedytowano użytkownika!</p>';
    }
}

function adding_acc_edit_inputs() {
    if (isset($_SESSION["edit_data"])) {
        echo '
        <input type="hidden"  name="user_id" value="' . $_SESSION["edit_data"]["user_id"] . '">
        <input type="hidden"  name="old_username" value="' . $_SESSION["edit_data"]["user_name"] . '">
        <input type="hidden"  name="old_email" value="' . $_SESSION["edit_data"]["user_email"] . '">
        ';
        echo '
        <div class="label-input">
            <label for="email">E-mail:</label>
            <input type="email" name="email" value="' . $_SESSION["edit_data"]["user_email"] . '">
        </div>
        ';

        echo '
        <div class="label-input">
            <label for="username">Nazwa:</label>
            <input type="text" name="username" value="' . $_SESSION["edit_data"]["user_name"] . '">
        </div>    
        ';
        echo '
        <div class="label-input">
            <label for="pwd">Hasło:</label>
            <input type="password" name="pwd" placeholder="Hasło(Wypełnij by zmienić!)">
        </div>    
        ';
        echo '
        <div class="label-input">
            <label for="group">Grupa:</label>
            <select name="group">
                <option '; if($_SESSION["edit_data"]["user_group"] == 1 ){ echo 'selected';} echo' value="1">Użytkownik</option>
                <option '; if($_SESSION["edit_data"]["user_group"] == 2 ){ echo 'selected';} echo' value="2">Pracownik</option>
                <option '; if($_SESSION["edit_data"]["user_group"] == 3 ){ echo 'selected';} echo' value="3">Administrator</option>
            </select>
        </div>
        '; 
        unset($_SESSION["edit_data"]);
    }
    
}