<?php 
namespace deswelleJ\Blog\Model;
use PDO;
require_once("model/Manager.php");

class UsersManager extends Manager
{
    public function userAuthentification($login){
        $db =$this->dbConnection();
        $req= $db->prepare('SELECT id, firstname, lastname, password, role FROM users WHERE email = :login');
        $req->bindValue(':login', $login, PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetchAll();
        return $user;
    }
}
