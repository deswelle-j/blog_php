<?php
      require('database.php');
      //connexion à la base de donnée blog_php
      $db = connexion();
      //preparation d'une requette sql :
      //selectionner les 5 derniers billets
      $req = $db->query('SELECT * FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
      $reponse= $req->fetchAll();
      require('homeVue.php');
?>

