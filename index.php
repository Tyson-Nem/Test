<?php
session_start();
require('controler/controler.php');
try {

    if (!isConnected()) {
        userConnect();
    } else {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'listTables':
                    listTables();
                    break;
                case 'userParam':
                    userParam();
                    break;
                case 'deconnexion':
                    deconnexion();
                    break;
                case 'userParam':
                    userParam();
                    break;
            }
        } else {
            listTables();
        }
    }
    if (isset($_GET['error'])) {
        echo '<script> alert("' . $_GET['error'] . '");</script>';
    }
} catch (Exception $e) {
    $char;
    if (strpos($_SERVER['HTTP_REFERER'], '?')) {
        $char = '&';
    } else {
        $char = '?';
    }
    header("Location: " . $_SERVER['HTTP_REFERER'] . $char  . "error=" . $e->getMessage());
}