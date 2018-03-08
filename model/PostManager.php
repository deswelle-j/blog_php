<?php
namespace deswelleJ\Blog\Model;
use PDO;
require_once("model/Manager.php");
class PostManager extends Manager
{
    public function getPosts(){
        // require_once('database.php');
        $db = $this->connection();
        $req = $db->query('SELECT * FROM posts ORDER BY date_creation DESC LIMIT 0, 5');
        $reponse= $req->fetchAll();
        
        $req->closeCursor();
        return $reponse;
    }
    
    public function getPost($postId){
        // require_once('database.php');
        $db = $this->connection();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_creation 
        FROM posts WHERE id= :id');
        $req->bindValue(':id', $postId, PDO::PARAM_INT);
        $req->execute();
        $reponse=$req->fetch();
        $req->closeCursor();
        return $reponse;
    } 
}