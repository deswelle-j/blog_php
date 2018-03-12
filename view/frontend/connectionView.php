<?php
session_start();  // démarre la gestion de session PHP
var_dump($_POST);
if (isset($_POST['inputEmail'], $_POST['inputPassword'])) {
    $db = new PDO('mysql:host=localhost;dbname=blog_php', 'root', '');
    echo 'test d\'entré <br/>';
    // Nous partons du principe dans cet exemple que le login de l'utilisateur est son mail
    $login = trim($_POST['inputEmail']);
    $password =trim($_POST['inputPassword']);
var_dump($login);
    // Pour éviter une requête inutile, on peut vérifier que l'utilisateur a bien saisi un mail valide et que le password n'est pas vide.
    if (filter_var($login, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        echo ' deuxieme test<br/>';
        // On va chercher en base de donnée l'ID, le prénom, le nom et le mot de passe haché correspodnant au mail spécifié
        $query = $db->prepare('SELECT id, firstname, lastname, password, role FROM users WHERE email = :login');
        $query->bindValue(':login', $login, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetchAll();
        $count = count($user);
        var_dump($count);
        // On compte le nombre de résultats retournés (1 si l'utilisateur existe) et on compare le mot de passe à sa version hachée
        if (count($user) > 0 && password_verify($password, $user[0]['password'])) {

            // L'utilisateur existe bien en base de donnée avec le mail spécifié, et le mot de passe correspond, il est donc authentifié
            $_SESSION['user'] = $user[0]['id'];
            $_SESSION['user_fullname'] = $user[0]['firstname'] . ' ' . $user[0]['lastname'];
            $_SESSION['user_role'] = $user[0]['role'];
            echo 'loged !!!!';
            var_dump($_SESSION);
            if ($_SESSION['user_role'] == 'admin'){
                header('Location: ../backend/administrationView.php');
            }
            
        } else {

            // Utilisateur non trouvé ou mot de passe incorrect

        }
    } else {

        // Informations de connexion incorrectes

    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,700" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>


    <div class="text-center">
        <form method="post" class="form-signin">
            <input type="hidden" name="form-signin" value="1"/>
            <h1 class="h3 mb-3 font-weight-normal">Connection</h1>
            <div class="form-label-group">
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Votre email" required autofocus value="">
                <label for="inputEmail">Email address</label>
            </div>

            <div class="form-label-group">
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Votre mot de passe" required>
                <label for="inputPassword">Password</label>
            </div>

            <button type="submit" class="btn btn-lg btn-primary btn-block">Valider</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>


