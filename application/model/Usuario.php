<?php
class Usuario {
    private $id;
    private $msisdn;
    private $name;
    private $access_level;
    private $password;
    private $external_id;
    private $grupo;
    
    function __construct($id, $msisdn, $name, $access_level, $password, $external_id, $grupo) {
        $this->id = $id;
        $this->msisdn = $msisdn;
        $this->name = $name;
        $this->access_level = $access_level;
        $this->password = $password;
        $this->external_id = $external_id;
        $this->grupo = $grupo;
    }
    
    function getId() {
        return $this->id;
    }

    function getMsisdn() {
        return $this->msisdn;
    }

    function getName() {
        return $this->name;
    }

    function getAccess_level() {
        return $this->access_level;
    }

    function getPassword() {
        return $this->password;
    }

    function getExternal_id() {
        return $this->external_id;
    }

    function getGrupo() {
        return $this->grupo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setMsisdn($msisdn) {
        $this->msisdn = $msisdn;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setAccess_level($access_level) {
        $this->access_level = $access_level;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setExternal_id($external_id) {
        $this->external_id = $external_id;
    }

    function setGrupo($grupo) {
        $this->grupo = $grupo;
    }


}