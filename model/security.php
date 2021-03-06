<?php

require_once 'model/User.php';
require_once 'connectDB.php';

function connexion(string $mail, string $password): bool
{
    $user = new User();
    if ($user->checkUser($mail, $password)) {
        $_SESSION['user'] = $mail;
        return true;
    } else {
        session_destroy();
        return false;
    }
}

function deconnexion(): bool
{
    session_destroy();
    header('Location: index.php');
    return true;
}

function isConnected(): bool
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

function getUser(): ?User
{
    if (isConnected()) {
        $user = new User();
        $user->load($_SESSION['user']);
        return $user;
    } else {
        return null;
    }
}