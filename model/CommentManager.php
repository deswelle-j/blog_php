<?php
namespace deswelleJ\Blog\Model;
use PDO;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId){
        // require_once('database.php');
        $db = $this->connection();
         $req= $db->prepare('SELECT id, author, comment, id_post, DATE_FORMAT(date_comment, "%d/%m/%Y à %Hh%imin%ss") AS dateComment 
         FROM comments WHERE id_post = :id ORDER BY date_comment DESC');
         $req->bindValue(':id', $postId, PDO::PARAM_INT);
         $req->execute();
         $reponse=$req->fetchAll();
        $req->closeCursor();
        return $reponse;
    }
    
    public function postComment($author, $comment, $idPost){
        $db = $this->connection();
        $req = $db->prepare('INSERT INTO comments(author, comment, id_post, date_comment) 
        VALUES(:author, :comment, :id_post, NOW())');
        $req->bindValue(':author', $author, PDO::PARAM_STR);
        $req->bindValue(':comment', $comment, PDO::PARAM_STR);
        $req->bindValue(':id_post', $idPost, PDO::PARAM_INT);
        $affectedLines = $req->execute();
        $req->closeCursor();
        return $affectedLines;
    }

    public function updateCommentDb($comment, $idComment){
        $db = $this->connection();
        $req = $db->prepare('UPDATE comments SET comment = :comment WHERE id = :idComment');
        $req->bindValue(':comment', $comment, PDO::PARAM_STR);
        $req->bindValue(':idComment', $idComment, PDO::PARAM_INT);
        $req->execute();

    }

}