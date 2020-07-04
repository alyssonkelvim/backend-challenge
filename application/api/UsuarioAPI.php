<?php

require_once 'model/Usuario.php';

class UsuarioAPI {

    private $url = "https://api2.mlearn.mobi/integrator/qualifica/users";
    private $headers = array(
        'Authorization:Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w',
        'service-id:qualifica',
        'app-users-group-id:20'
    );

    public function insert(Usuario $usuario) {

        // Cria o cURL
        $curl = curl_init($this->url);
        // Seta algumas opções
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POSTFIELDS => $this->setInfo($usuario)
        ]);

        // Envia a requisição e salva a resposta
        $response = curl_exec($curl);
        // Fecha a requisição e limpa a memória
        curl_close($curl);
  
    }

    public function update(Usuario $usuario) {
        // Cria o cURL
        $curl = curl_init($this->url);
        // Seta algumas opções
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POSTFIELDS => $this->setInfo($usuario),
            CURLOPT_CUSTOMREQUEST=> "PUT"
        ]);

        // Envia a requisição e salva a resposta
        $response = curl_exec($curl);
        // Fecha a requisição e limpa a memória
        curl_close($curl);
        print_r($response);
    }
    
    public function downgrade(Usuario $usuario) {
        // Cria o cURL
        $curl = curl_init($this->url."/".$usuario->getId()."/downgrade");
        $usuario->setAccess_level("free");
        // Seta algumas opções
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POSTFIELDS => $this->setInfo($usuario),
            CURLOPT_CUSTOMREQUEST => "PUT"
        ]);

        // Envia a requisição e salva a resposta
        $response = curl_exec($curl);
        // Fecha a requisição e limpa a memória
        curl_close($curl);
        print_r($response);
    }
    
    public function upgrade(Usuario $usuario) {
  
        $curl = curl_init($this->url."/".$usuario->getId()."/upgrade");
        $usuario->setAccess_level("premium");
        // Seta algumas opções
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POSTFIELDS => $this->setInfo($usuario),
            CURLOPT_CUSTOMREQUEST => "PUT"
        ]);

        // Envia a requisição e salva a resposta
        $response = curl_exec($curl);
        // Fecha a requisição e limpa a memória
        curl_close($curl);
        print_r($response);
    }

    public function findByExternalId($id) {
        // Cria o cURL
        $curl = curl_init();
        // Seta algumas opções
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->url . "?external_id=$id",
            CURLOPT_HTTPHEADER => $this->headers
        ]);

        // Envia a requisição e salva a resposta
        $response = curl_exec($curl);
        // Fecha a requisição e limpa a memória
        curl_close($curl);
        print_r($this->getInfo($response));
        $usuario = $this->getInfo($response);
        $usuario->setExternal_id($id);
        return $usuario;
    }
    
     public function findById($id) {
        // Cria o cURL
        $curl = curl_init();
        // Seta algumas opções
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->url . "/$id",
            CURLOPT_HTTPHEADER => $this->headers
        ]);

        // Envia a requisição e salva a resposta
        $response = curl_exec($curl);
        // Fecha a requisição e limpa a memória
        curl_close($curl);
        print_r($this->getInfo($response));
        $usuario = $this->getInfo($response);
        $usuario->setExternal_id($id);
        return $usuario;
    }

    public function findByArray($usuarios) {
        $users = array();
        foreach ($usuarios as $usuario) {
            $users[] = $this->findById($usuario->getId());
        }
        return $users;
    }

    private function getInfo($response) {
        $obj = json_decode($response);
        $obj = $obj->{'data'};
        $usuario = new Usuario();
        $usuario->setId($obj->{'id'});
        $usuario->setAccess_level($obj->{'access_level'});
        $usuario->setMsisdn($obj->{'msisdn'});
        $usuario->setName($obj->{'name'});
        return $usuario;
    }
    
     public function delete(Usuario $usuario) {
        // Cria o cURL
        $curl = curl_init($this->url."/".$usuario->getId());
        // Seta algumas opções
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POSTFIELDS => $this->setInfo($usuario),
            CURLOPT_CUSTOMREQUEST => "DELETE"
        ]);

        // Envia a requisição e salva a resposta
        $response = curl_exec($curl);
        // Fecha a requisição e limpa a memória
        curl_close($curl);
        print_r($response);
    }
    
    private function setInfo(Usuario $usuario){
        
        $obj = array(
            'id' => $usuario->getId(),
            'access_level'=> $usuario->getAccess_level(),
            'external_id' => $usuario->getExternal_id(),
            'msisdn' => $usuario->getMsisdn(),
            'name' => $usuario->getName(),
            'password' => $usuario->getPassword()
        );
        return $obj;
    }

}
