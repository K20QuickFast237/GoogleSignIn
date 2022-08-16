<?php
    session_start();
    $state = bin2hex(random_bytes(128/8));
    $_SESSION['state'] = $state;
    unset($state);
    require('config.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>
<body>

    <h2>Connexion <?= $_SESSION['state'] ?></h2>
    <!-- <a href="https://accounts.google.com/o/oauth2/v2/auth?scope=openid%20profile%20email&access_type=online&response_type=code&redirect_uri=<#?= urlencode('http://localhost/OAuth/connect.php') ?>&client_id=<#?= GOOGLE_OAUTH_ID ?>&state=<#?= $_SESSION['state'] ?>">  -->
    <a href="https://accounts.google.com/o/oauth2/v2/auth?scope=openid%20profile%20email&access_type=online&response_type=code&redirect_uri=<?= urlencode('http://localhost/OAuth/connect.php') ?>&client_id=<?= GOOGLE_OAUTH_ID ?>"> 
        <button type="submit"> Se connecter avec google </button>
    </a>
</body>
</html>
