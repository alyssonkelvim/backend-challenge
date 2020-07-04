<?php

require_once 'model/Grupo.php';
require_once 'util/Conexao.php';

class GrupoDAO {


    public function insert(Grupo $grupo) {
        $sql = "INSERT INTO Grupo (
            id,
            group_id,
            title)                
                            VALUES (
            :id,
            :group_id,
            :title)";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $grupo->getId());
        $p_sql->bindValue(":group_id", $grupo->getGroup_id());
        $p_sql->bindValue(":title", $grupo->getTitle());
        return $p_sql->execute();
    }

    public function update(Grupo $grupo) {
        $sql = "UPDATE Grupo SET
            id= :id,
            group_id= :group_id,
            title= :title WHERE id = :id";

        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $grupo->getId());
        $p_sql->bindValue(":group_id", $grupo->getGroup_id());
        $p_sql->bindValue(":title", $grupo->getTitle());
        return $p_sql->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM Grupo WHERE id = :id";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);

        return $p_sql->execute();
    }

    public function findById($id) {
        $sql = "SELECT * FROM Grupo WHERE id = :id";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        $p_sql->execute();
        return $this->getInfo($p_sql->fetch(PDO::FETCH_ASSOC));
    }

    public function findAll() {
        $sql = "SELECT * FROM Grupo";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->execute();
        $lista = array();
        $result = $p_sql->fetchAll();
        foreach ($result as $row) {
            $lista[] = $this->getInfo($row);
        }
        return $lista;
    }

    private function getInfo($row) {
        $grupo = new Grupo();
        $grupo->setId($row['id']);
        $grupo->setGroup_id($row['group_id']);
        $grupo->setTitle($row['title']);
        return $grupo;
    }

}
?>

