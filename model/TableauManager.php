<?php

require_once 'connectDB.php';

class TableauManager
{
    /**
     * Retourne toutes les tableaux d'un utilisateur
     *
     * @param int $userId
     * @return PDOStatement|false
     */
    public function getTables(int $userId): PDOStatement|false
    {
        $dbh = new PDO(DSN, LOGIN, PASSWORD, array(PDO::ATTR_PERSISTENT => true));
        $tables = $dbh->prepare("select id, nom_tableau from tableau where id_utilisateur = :userId");
        $tables->execute(array('userId' => $userId));

        return $tables;
    }


    /**
     * Retourne toutes les tableaux d'un utilisateur
     *
     * @param int $userId id de l'utilisateur
     * @param int $tableId id du tableau choisi
     * @return mixed renvoi le tableau si disponible sinon false
     */
    public function getTable(int $userId, int $tableId): mixed
    {
        $dbh = new PDO(DSN, LOGIN, PASSWORD, array(PDO::ATTR_PERSISTENT => true));
        $table = $dbh->prepare("select id, nom_tableau from tableau where id = :tableId and id_utilisateur = :userId");
        $table->execute(array('tableId' => $tableId, 'userId' => $userId));
        if ($row = $table->fetch()) {
            return $row;
        }

        return false;
    }

    /**
     * Crée une catégorie
     *
     * @param int $userId
     * @param string $tableName
     * @return bool Retourne true si création réussi sinon false
     */
    public function createTable(int $userId, string $tableName): bool
    {
        $dbh = new PDO(DSN, LOGIN, PASSWORD, array(PDO::ATTR_PERSISTENT => true));
        $table = $dbh->prepare("INSERT INTO tableau (id_utilisateur, nom_tableau) VALUES (:userID, :tableName)");
        $affectedLines = $table->execute(array('userID' => $userId, 'tableName' => $tableName));

        return $affectedLines;
    }
}