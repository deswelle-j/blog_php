<?php


class PostManager
{
    public function getPosts(){
        require_once('database.php');
        $db = $this->connection();
        $req = $db->query('SELECT * FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
        $reponse= $req->fetchAll();
        
        $req->closeCursor();
        return $reponse;
    }
    
    public function getPost($postId){
        require_once('database.php');
        $db = $this->connection();
        $req = $db->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_creation 
        FROM billets WHERE id= :id');
        $req->bindValue(':id', $postId, PDO::PARAM_INT);
        $req->execute();
        $reponse=$req->fetch();
        $req->closeCursor();
        return $reponse;
    } 

    private function connection() {

        // options's array for connection
        $db_options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // On affiche des warnings pour les erreurs, à commenter en prod (valeur par défaut PDO::ERRMODE_SILENT)
        );
    
            $db = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASS, $db_options);
        return $db;
    }


}