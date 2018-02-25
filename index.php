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

      //preparation d'une requette sql :
      //selectionner les 5 derniers billets
      $req = $db->query('SELECT * FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
      $reponse= $req->fetchAll();
      //afficher les billets, avec un lien vers les commentaires de ceux-ci, du plus recent au plus ancien
      foreach ($reponse as $donnée){
          echo '<div class="post"><h2>' . $donnée['titre'] . '</h2><p>' .$donnée['contenu'] . '</p>';
          echo '<a href=commentaires.php?id_billet=' .$donnée['id'] .'>Commentaires</a></div>';
      }

      //Fermeture du curseur
      $req->closeCursor();
      ?>
    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>