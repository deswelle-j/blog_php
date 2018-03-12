<?php 
namespace deswelleJ\Blog\Model;
use PDO;
require_once("model/Manager.php");

class UsersManager extends Manager
{
    public function userAuthentification(){
        $db =$this->dbConnection();

    }
}
