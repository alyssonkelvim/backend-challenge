<?php
require_once 'model/Usuario.php';
require_once 'model/Grupo.php';
require_once 'dao/GrupoDAO.php';
require_once 'util/Conexao.php';

class UsuarioDAO {

    public function insert(Usuario $usuario) {
        $sql = "INSERT INTO Usuario (
            id,
            msisdn,
            name,
            access_level,
            password,
            external_id,
            grupo
        )
        VALUES (
            :id,
            :msisdn,
            :name,
            :access_level,
            :password,
            :external_id,
            :grupo
        )";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $usuario->getId());
        $p_sql->bindValue(":msisdn", $usuario->getMsisdn());
        $p_sql->bindValue(":name", $usuario->getName());
        $p_sql->bindValue(":access_level", $usuario->getAccess_level());
        $p_sql->bindValue(":password", $usuario->getPassword());
        $p_sql->bindValue(":external_id", $usuario->getExternal_id());
        $p_sql->bindValue(":grupo", $usuario->getGrupo()->getId());
        return $p_sql->execute();
    }

    public function update(Usuario $usuario) {
        $sql = "UPDATE Usuario SET
            id= :id,
            msisdn= :msisdn,
            name= :name,
            access_level= :access_level,
            password= :password,
            external_id= :external_id,
            grupo= :grupo WHERE id = :id";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $usuario->getId());
        $p_sql->bindValue(":msisdn", $usuario->getMsisdn());
        $p_sql->bindValue(":name", $usuario->getName());
        $p_sql->bindValue(":access_level", $usuario->getAccess_level());
        $p_sql->bindValue(":password", $usuario->getPassword());
        $p_sql->bindValue(":external_id", $usuario->getExternal_id());
        $p_sql->bindValue(":grupo", $usuario->getGrupo()->getId());
        return $p_sql->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM Usuario WHERE id = :id";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        return $p_sql->execute();
    }

    public function findById($id) {
        $sql = "SELECT * FROM Usuario WHERE id = :id";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        $p_sql->execute();
        return $this->getInfo($p_sql->fetch(PDO::FETCH_ASSOC));
    }

    public function findAll() {
        $sql = "SELECT * FROM Usuario";
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
        $usuario = new Usuario();
        $grupoDAO = GrupoDAO::getInstance();
        $usuario->setId($row['id']);
        $usuario->setMsisdn($row['msisdn']);
        $usuario->setName($row['name']);
        $usuario->setAccess_level($row['access_level']);
        $usuario->setPassword($row['password']);
        $usuario->setExternal_id($row['external_id']);
        $usuario->setGrupo($grupoDAO->findById($row['grupo']));
        return $usuario;
    }

}

?>
