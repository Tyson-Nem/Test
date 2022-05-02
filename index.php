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




    // if (isset($_GET['action'])) {
    //     if ($_GET['action'] == 'listPosts') {
    //         listPosts();
    //     }
    //     elseif ($_GET['action'] == 'post') {
    //         if (isset($_GET['id']) && $_GET['id'] > 0) {
    //             post();
    //         }
    //         else {
    //             throw new Exception('Aucun identifiant de billet envoyé');
    //         }
    //     }
    //     elseif ($_GET['action'] == 'addComment') {
    //         if (isset($_GET['id']) && $_GET['id'] > 0) {
    //             if (!empty($_POST['author']) && !empty($_POST['comment'])) {
    //                 addComment($_GET['id'], $_POST['author'], $_POST['comment']);
    //             }
    //             else {
    //                 throw new Exception('Tous les champs ne sont pas remplis !');
    //             }
    //         }
    //         else {
    //             throw new Exception('Aucun identifiant de billet envoyé');
    //         }
    //     }
    // }
    // else {
    //     listPosts();
    // }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}