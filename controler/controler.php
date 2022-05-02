<?php

// Chargement des classes
require_once('model/TableauManager.php');
require_once('model/CategoryManager.php');
require_once('model/User.php');
require_once('model/security.php');

function userConnect()
{
    if (isset($_POST['connect'])) {
        if (connexion($_POST['mail'], $_POST['password'])) {
            header('Location: index.php?action=listTables');
        } else {
            echo '<script type="text/javascript">
                alert("Le mot de passe ou email invalide");
         </script>';
        }
    } elseif (isset($_POST['create'])) {
        if ($_POST['password'] === $_POST['repassword']) {
            $user = new User($_POST['mail'], $_POST['password'], $_POST['name'], $_POST['firstname']);
            $user->save();
            connexion($user->getMail(), $user->getPassword());
            header('Location: index.php?action=listTables');
        } else {
            echo '<script type="text/javascript">
                alert("Les mots de passe ne correspondent pas");
         </script>';
        }
    }

    require('view/pageConnexion.php');
}

function listTables()
{
    $citation = array("Loosh, là où les mamans vont !", "Loosh pour tous.", "Loosh, savoure chaque gorgée.", "Goûte la Loosh.", "Entre dans ma Loosh.", "Loosh. C'est partout où tu veux être.", "Loosh pour l'éternité.", "Tendu ? Stressé ? Essaie Loosh.", "Profondément Loosh.", "Loosh, ressens la sensation de bien-être au plus profond de toi.", "Avez-vous pris votre Loosh aujourd'hui ?", "Ne joue pas avec le feu, joue avec Louche.", "Loosh, spécialement pour elle.", "J'ai arrêté de fumer grâce à Loosh.");
    $rand_keys = array_rand($citation, 1);
    $poetes = array("Hervé Crevan", "Socrate", "Spiderman", "Maman", "Rocco Siffredi", "Clara Morgane", "Jean-Claude Van Damme", "Ton arrière grand-père, le chauve");
    $p_rand_keys = array_rand($poetes, 1);

    $tableauManager = new TableauManager(); // Création d'un objet
    $user = getUser();

    if (isset($_POST['submit'])) {
        if ($tableauManager->createTable($user->getId(), $_POST['name'])) {
            header('Location: index.php?action=Table');
        } else {
            echo 'Création impossible';
        }
    }

    $tables = $tableauManager->getTables($user->getId()); // Appel d'une fonction de cet objet
    $bool = true;

    require('view/pageAccueil.php');
}

function userParam()
{
    $user = getUser();
    if (isset($_POST['modif'])) {
        if ($_POST['password'] === $_POST['repassword']) {
            $userTemp = new User($user->getMail(), $_POST['password'], $_POST['name'], $_POST['firstname']);
            $userTemp->setId($user->getId());
            $userTemp->save();
            header('Location: index.php?action=userParam');
        } else {
            echo '<script type="text/javascript">
                alert("Les mots de passe ne correspondent pas");
         </script>';
        }
    }

    require('view/pageParametre.php');
}

// function post()
// {
//     $postManager = new PostManager();
//     $commentManager = new CommentManager();

//     $post = $postManager->getPost($_GET['id']);
//     $comments = $commentManager->getComments($_GET['id']);

//     require('view/postView.php');
// }

// function addComment($postId, $author, $comment)
// {
//     $commentManager = new CommentManager();

//     $affectedLines = $commentManager->postComment($postId, $author, $comment);

//     if ($affectedLines === false) {
//         throw new Exception('Impossible d\'ajouter le commentaire !');
//     }
//     else {
//         header('Location: index.php?action=post&id=' . $postId);
//     }
// }