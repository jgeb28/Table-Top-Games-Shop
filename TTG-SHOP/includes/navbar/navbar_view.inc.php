<?php 

function go_to_profile() {
    if(isset($_SESSION["user_id"])) {
        if ($_SESSION["user_group_id"] === 3)
            echo '<li><a id="profile" href="/profile/admin/profile_admin.php"><img src="/images/profile.svg"></a></li>';
        else if ($_SESSION["user_group_id"] === 2)
            echo '<li><a id="profile" href="/profile/employee/profile_employee.php"><img src="/images/profile.svg"></a></li>';
        else
            echo '<li><a id="profile" href="/profile/user/profile_user.php"><img src="/images/profile.svg"></a></li>';
    } else {
        echo '<li><a id="profile" href="/login.php"><img src="/images/profile.svg"></a></li>';
    }
}