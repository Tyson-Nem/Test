<?php

require_once 'connectDB.php';

class CategoryManager
{
    /**
     * Retourne toutes les catégories d'un tableau
     *
     * @param int $tableId
     * @return PDOStatement|false
     */
    public function getCatergories(int $tableId): PDOStatement|false
    {
        $dbh = new PDO(DSN, LOGIN, PASSWORD, array(PDO::ATTR_PERSISTENT => true));
        $tables = $dbh->prepare("SELECT id, nom_categorie FROM categorie WHERE id_tableau = :tableId");
        $tables->execute(array('tableId' => $tableId));

        return $tables;
    }


    /**
     * Crée une catégorie
     *
     * @param integer $tableId
     * @param string $categoryName
     * @return bool Retourne true si création réussi sinon false
     */
    public function createCategory(int $tableId, string $categoryName): bool
    {
        $dbh = new PDO(DSN, LOGIN, PASSWORD, array(PDO::ATTR_PERSISTENT => true));
        $table = $dbh->prepare("INSERT INTO categorie (id_tableau, nom_tableau) VALUES (:tableId, :categoryName)");
        $affectedLines = $table->execute(array('tableId' => $tableId, 'categoryName' => $categoryName));

        return $affectedLines;
    }
}