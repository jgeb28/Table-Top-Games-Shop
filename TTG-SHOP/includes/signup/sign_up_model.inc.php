<?php

declare(strict_types=1);


function get_username(object $pdo, string $username) {

    $query = "SELECT user_name FROM users WHERE user_name = :user_name;";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    $stmt->bindParam(":user_name",$username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch using name of the column

    return $result;
}

function get_email(object $pdo, string $email) {

    $query = "SELECT user_name FROM users WHERE user_email = :user_email;";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    $stmt->bindParam(":user_email",$email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch using name of the column

    return $result;
}

function set_user(object $pdo, string $username, string $pwd, string $email) {

    $query = "INSERT INTO users (user_name, user_email, user_pwd ) 
    VALUES (:user_name, :user_email, :user_pwd);";
    $stmt = $pdo->prepare($query); // sending querry separetly from data for security
    //hashing password

    $options = [
        'cost' => 12 /*adding cost to hash*/
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":user_name",$username);
    $stmt->bindParam(":user_pwd",$hashedPwd);
    $stmt->bindParam(":user_email",$email);
    $stmt->execute();

}