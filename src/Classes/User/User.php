<?php

namespace src\Classes\User;

class User {

    private $connMysql;
    private $username;
    private $email;
    private $user_id;
    private $permissions;

    public function __construct($pdo)
    {
        $this->connMysql = $pdo;
    }

    public function loginUser($username, $password) 
    {
        $sql = "SELECT * FROM usuarios WHERE nome = '$username' AND senha = '$password'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        if ($sql->rowCount() > 0) {
            $user_data = $sql->fetch();
            return $user_data;
            return true;
        } else {
            return false;
        }
    }

    public function registerNewUser($username, $email, $password) 
    {
        if($this->verifyEmailExists($email)) {
            return false;
        } else {
            $sql = "INSERT INTO `usuarios`(`nome`, `email`, `senha`) VALUES ('$username', '$email', '$password')";
            $sql = $this->connMysql->prepare($sql);
            $sql->execute() or die(print_r($sql->errorInfo(), true));
            return true;
        }
    }

    public function verifyEmailExists($email) 
    {
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false; 
        }
    }

    public function setUser($id) 
    {
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        if ($sql->rowCount() > 0) {
            $user_data = $sql->fetch();
            $this->username = $user_data['nome'];
            $this->email = $user_data['email'];
            $this->user_id = $user_data['id'];
            $this->permissions = explode(',', $user_data['permissoes']);
        } else {
            header("location: login.php");
        }
    }

    public function getUsername() 
    {
        return $this->username;
    }

    public function getUseremail() 
    {
        return $this->email;
    }
    public function getUserId() 
    {
        return $this->user_id;
    }
    
    public function getPermissions() 
    {
        return $this->permissions;
    }

    public function permissions($acess) 
    {
        if(in_array($acess, $this->permissions)) {
            return true;
        } else {
            return false;
        }
    }

}



?>