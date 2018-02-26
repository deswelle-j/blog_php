<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Blog php</title>
  </head>
  <body>
    <main class="container">
      <h1>Ceci est un prototype simpliste de blog</h1>
      <a href="index.php">Retour à la liste de billets</a>
      <?php
      //connexion à la base de donnée blog_php
      try
      {
          $db = new PDO('mysql:host=localhost;dbname=blog_php;charset=utf8', 'root', '');
      }
      catch (Exception $e)
      {
          die('Erreur : ' .$e->getMessage());
      }
      //preparation d'une requette sql : selectionner le billet passer en $_GET
      $id= $_GET['id_billet'];
      // var_dump($id);
      $req = $db->prepare('SELECT titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_creation FROM billets WHERE id= :id');
      //execution de la requette avec le parametre $_GET['id']
      $req->bindValue(':id', $id, PDO::PARAM_INT);
      $req->execute();
      $reponse=$req->fetch();
      // var_dump($reponse);

      //afficher le billet
      echo '<div class="post"><h2>'.$reponse['titre'] . ' le ' . $reponse['date_creation'] .'</h2><p>'. $reponse['contenu'] .'</p></div>';
      
      //femer le curseur de la base de donnée
      $req->closeCursor();
      echo '<h3>Commentaires</h3>';
      //Preparation d'une nouvelle requette sql: Selectionner les commentaires du billet
      $req= $db->prepare('SELECT auteur, commentaire, id_billet, DATE_FORMAT(date_commentaire, "%d/%m/%Y à %Hh%imin%ss") AS date_commentaire FROM commentaires WHERE id_billet = :id ORDER BY date_commentaire');
      $req->bindValue(':id', $id, PDO::PARAM_INT);
      $req->execute();
      $reponse=$req->fetchAll();
      //afficher les commentaires du plus recent au plus ancien
      if(!empty($reponse)){
        foreach($reponse as $donnée){
          echo '<div class="comment"><h4>'.$donnée['auteur'] . ' le '. $donnée['date_commentaire'] .'</h4><p>'. $donnée['commentaire'] .'</p></div>';
    
        }
      }else{
        echo '<div><h4>Ce billet ne contient pas de commentaire pourquoi ne pas en mettre un ?</h4></div>';
      }
      $req->closeCursor();
      ?>
      <!-- Formulaire de saisie pour ajouter un commentaire en method post
      Redirection ver la page commentaires_post pour traitement de la requette d'insertion -->
      <div>
        <form action="commentaires_post.php" method="post">
        <p>Ajoute un commentaire</p>
        <label for="auteur">Pseudo</label>
        <input id="auteur" name="auteur" type="text">
        <label for="commentaire">Commentaire</label>
        <input id="commentaire" name="commentaire" type="text">
        <input type="text" name="id_billet" value="<?php echo $id ?>" style="visibility: hidden;">
        <input type="submit" value="Envoyer">
        </form>
      </div>  
    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>