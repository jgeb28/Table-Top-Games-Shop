<?php

declare(strict_types=1);


function get_username(object $pdo, string $username)
{

    $query = "SELECT user_name FROM users WHERE user_name = :user_name;";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    $stmt->bindParam(":user_name", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch using name of the column

    return $result;
}

function get_email(object $pdo, string $email)
{

    $query = "SELECT user_name FROM users WHERE user_email = :user_email;";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    $stmt->bindParam(":user_email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch using name of the column

    return $result;
}

function set_user(object $pdo, string $username, string $pwd, string $email, string $group)
{

    $query = "INSERT INTO users (user_name, user_email, user_pwd, group_id ) 
    VALUES (:user_name, :user_email, :user_pwd, :group_id);";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    //hashing password

    $options = [
        'cost' => 12 /*adding cost to hash*/
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":user_name", $username);
    $stmt->bindParam(":user_pwd", $hashedPwd);
    $stmt->bindParam(":user_email", $email);
    $stmt->bindParam(":group_id", $group);
    $stmt->execute();
}

function get_users(object $pdo)
{
    $query = "SELECT users.user_name,
    users.user_id, users.user_email, users.group_id,
    groups.group_name
    FROM users
    JOIN groups ON users.group_id = groups.group_id;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function delete_user(object $pdo, string $userId)
{
    $query = "DELETE FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $userId);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function edit_user(object $pdo, string $userId, ?string $username, ?string $pwd, ?string $email, string $group)
{

    $query = "UPDATE users";
    $querycond = " WHERE user_id = :user_id;";
    $queryset = " SET ";
    if ($username != null)
        $queryset = $queryset . "user_name=:user_name, ";
    if ($pwd != null) {
        $queryset = $queryset . "user_pwd=:user_pwd, ";

        $options = [
            'cost' => 12
        ];
        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
    }
    if ($email != null)
        $queryset = $queryset . "user_email=:user_email, ";
    $queryset = $queryset . "group_id=:group_id";

    $query = $query . $queryset . $querycond;
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_id", $userId);
    if ($username != null)
        $stmt->bindParam(":user_name", $username);
    if ($pwd != null)
        $stmt->bindParam(":user_pwd", $hashedPwd);
    if ($email != null)
        $stmt->bindParam(":user_email", $email);
    $stmt->bindParam(":group_id", $group);
    $stmt->execute();
}

function search_users(object $pdo, string $search)
{
    $query = "SELECT users.user_name,
    users.user_id, users.user_email, users.group_id,
    groups.group_name
    FROM users
    JOIN groups ON users.group_id = groups.group_id
    WHERE users.user_name LIKE :search OR users.user_email LIKE :search ";
    $stmt = $pdo->prepare($query);
    $searchParam = "%$search%";
    $stmt->bindParam(':search', $searchParam);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
