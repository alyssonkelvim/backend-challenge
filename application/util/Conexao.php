<?php

class Conexao {

    private static $instance;

    private function __contruct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = Conexao::getConexao();
        }

        return self::$instance;
    }

    private static function getConexao() {
        $tipo = "mysql";
        $servidor = "162.214.111.221";
        $banco = "suporteq_mlearn";
        $usuario = "suporteq_mlearn";
        $senha = "9SLKCC38VB1S";
        try {
            $con = new PDO("$tipo:host=" . $servidor . ";dbname=" . $banco, $usuario, $senha);
        } catch (PDOException $e) {
            echo ('Conexao: ' . $e->getCode());
        }
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }

}

?>