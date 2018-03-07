<?php
namespace deswelleJ\Blog\Model;
use PDO;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId){
        // require_once('database.php');
        $db = $this->connection();
         $req= $db->prepare('SELECT auteur, commentaire, id_billet, DATE_FORMAT(date_commentaire, "%d/%m/%Y à %Hh%imin%ss") AS date_commentaire 
         FROM commentaires WHERE id_billet = :id ORDER BY date_commentaire');
         $req->bindValue(':id', $postId, PDO::PARAM_INT);
         $req->execute();
         $reponse=$req->fetchAll();
        $req->closeCursor();
        return $reponse;
    }
    
    public function postComment($author, $comment, $idPost){
        // require_once('database.php');
        $db = $this->connection();
            // $author = htmlspecialchars($_POST['auteur']);
            // $comment = htmlspecialchars($_POST['commentaire']);
            // $id_billet = htmlspecialchars($_POST['id_billet']);
        
            $req = $db->prepare('INSERT INTO commentaires(auteur, commentaire, id_billet, date_commentaire) 
            VALUES(:author, :comment, :id_billet, NOW())');
            $req->bindValue(':author', $author, PDO::PARAM_STR);
            $req->bindValue(':comment', $comment, PDO::PARAM_STR);
            $req->bindValue(':id_billet', $idPost, PDO::PARAM_INT);
            //Execution de la requette
            $affectedLines = $req->execute();
            // $req->execute(array($author, $comment));
            //Fermeture du curseur
            $req->closeCursor();
            return $affectedLines;
    }

}