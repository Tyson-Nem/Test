<?php

// Check form info
class ValidForm
{
    /**
     * Method isEmail
     * check if email address is valid 
     * 
     * @return boolean 
     */
    public function isEmail()
    {
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('L\'email est invalide');
        }
    }

    /**
     * Method isAlpha
     * ctype_alpha check if input is alphabetic character
     * 
     * @return boolean true if input is only letter else false
     */
    public function isAlpha()
    {
        $values = [$_POST['firstname'], $_POST['name']];
        foreach ($values as $value) {
            if (ctype_alpha($value) == false) {
                var_export($value);
                var_dump(ctype_alpha($value));
                throw new Exception('Chaine de caractere invalide');
            }
        }
    }

    /**
     * Method maxLenght
     * strlen count character in string
     * Input max lenght is 20 character 
     * 
     *@return int number of characters
     */

    public function maxLenght()
    {
        $values = [$_POST['firstname'], $_POST['name'], $_POST['password']];
        foreach ($values as $value) {
            if (strlen($value) > 20) {
                throw new Exception('Vous avez depassé la limite de caracteres autorisées');
            }
        }
    }

    /**
     * Method minLenght
     * strlen count character in string
     * Input min lenght is 3 character 
     * 
     *@return int number of characters
     */
    public function minLenght()
    {
        $values = [$_POST['firstname'], $_POST['name'], $_POST['password']];
        foreach ($values as $value) {
            if (strlen($value) < 3) {
                throw new Exception('Vous n\'avez pas entré assez de caracteres');
            }
        }
    }

    /**
     * Method mdpFormat
     * Regex : pass had to contain at least 1 letter (min & maj), 1 number and 1 (- + _ & =)
     * 
     * @return boolean 1 if all condition are valid else 0
     */
    public function mdpFormat()
    {
        $str = $_POST['password'];
        $exp = '/([a-z]+[A-Z]+[0-9]+[\-_&+=]+)/';

        if (preg_match($exp, $str) == 0) {
            throw new Exception('Mdp invalide');
        }
    }

    /**
     * Method imgFormat
     * $_FILES global var witch contains file loaded info's
     * 
     * @param $target_dir direction where img is going to be placed
     * @param $target_file gives the file path's
     * @param $imgFileType holds the file extension
     * @param $upload 0 if file is not valid else 1
     */
    public function imgFormat()
    {
        $target_dir = "./Test/assets/images/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $upload = 1;
        $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check is input is empty 
        if ($_FILES['image']['size'] == 0) {
            throw new Exception('Il n\'y a pas d\'image a telecharger');
        } else {

            // Check if file is already exists
            if (file_exists($target_file)) {
                throw new Exception('Le fichier existe deja');
                $upload = 0;
            } else {
                $upload = 1;
            }

            // Check file size 
            if ($_FILES['image']['size'] > 500000) {
                throw new Exception('Le fichier est trop volumineux');
                $upload = 0;
            } else {
                $upload = 1;
            }

            // Format allowed
            if ($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg") {
                throw new Exception('Formats autorisés : JPG , JPEG , PNG');
                $upload = 0;
            } else {
                $upload = 1;
            }

            // Check $upload
            if ($upload == 0) {
                throw new Exception('Le fichier n\'a pas pu etre telecharger');
            } else {
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    throw new Exception('Une erreur est survenue lors du telechargement');
                }
            }
        }
    }

    /**
     * Method fileFormat
     *$_FILES global var witch contains file loaded info's

     * @param $target_dir direction where file is going to be placed
     * @param $target_file gives the file path's
     * @param $imgFileType holds the file extension
     * @param $upload 0 if file is not valid else 1
     */
    public function fileFormat($userid, $tableid, $categorieid, $ficheid)
    {
        // if folder doesn't exist mkdir create it
        if (!file_exists("$userid/$tableid/$categorieid/$ficheid")) {
            mkdir("../assets/fichiers/$userid/$tableid/$categorieid/$ficheid", 0777, true);
        }

        $target_dir = "../assets/fichiers/$userid/$tableid/$categorieid/$ficheid/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        $upload = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check is input is empty 
        if ($_FILES['file']['size'] == 0) {
            throw new Exception('Il n\y a pas de fichier a telecharger');
        } else {

            // Check if file is already exists
            if (file_exists($target_file)) {
                throw new Exception('Le fichier existe deja');
                $upload = 0;
            } else {
                $upload = 1;
            }

            // Check file size 
            if ($_FILES['file']['size'] > 500000) {
                throw new Exception('Le fichier est trop volumineux');
                $upload = 0;
            } else {
                $upload = 1;
            }

            // Format allowed
            if ($fileType != "pdf" && $fileType != "docx" && $fileType != "txt" && $fileType != "doc") {
                throw new Exception('Formats autorisés : PDF , DOC , DOCX , TXT');
                $upload = 0;
            } else {
                $upload = 1;
            }

            // Check $upload
            if ($upload == 0) {
                echo 'Le fichier ' . htmlspecialchars(basename($_FILES['file']['name'])) . 'n\'a pas pu etre telechargé';
            } else {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                    throw new Exception('Une erreur est survenue lors du telechargement');
                } 
            }
        }
    }
}
