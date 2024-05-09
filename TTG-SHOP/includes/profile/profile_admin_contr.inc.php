<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email)
{

    if (empty($username) || empty($pwd) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

function is_edit_input_empty(string $username, string $email)
{

    if (empty($username) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email)
{

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $pdo, string $username)
{

    if (get_username($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}

function is_email_taken(object $pdo, string $email)
{

    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $username, string $pwd, string $email, string $group)
{

    set_user($pdo, $username, $pwd, $email, $group);
}

function is_username_changed(object $pdo, string $username, int  $userId) {

    $result = get_user_data($pdo, $userId);
    $oldName = $result["user_name"];

    if ($oldName != $username) {
        return true;
    } else {
        return false;
    }
}

function is_email_changed(object $pdo, string $email, int  $userId) {

    $result = get_user_data($pdo, $userId);
    $oldName = $result["user_email"];

    if ($oldName != $email) {
        return true;
    } else {
        return false;
    }
}