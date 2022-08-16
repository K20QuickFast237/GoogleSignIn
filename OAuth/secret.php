<?php

session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Secrete</title>
</head>
<body>
    <h1>Cette page n'est accesible que sous condition de connection</h1>
    
</body>
</html>