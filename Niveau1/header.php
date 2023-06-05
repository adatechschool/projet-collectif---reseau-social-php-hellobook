<?php
session_start();
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title> <?php echo $title; ?> </title>
        <meta name="author" content="Hanaa Coraline Elodie">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <img src="resoc.jpg" alt="Logo de notre réseau social"/>
            <nav id="menu">
                <a href="news.php">Actualités</a>
                <a href="<?php echo "wall.php?user_id=".$_SESSION['connected_id'] ?>">Mur</a>
                <a href="<?php echo "feed.php?user_id=".$_SESSION['connected_id'] ?>">Flux</a>
                <a href="tags.php?tag_id=1">Mots-clés</a>
            </nav>
            <nav id="user">
                <a href="#">Profil</a>
                <ul>
                    <li><a href="<?php echo "settings.php?user_id=".$_SESSION['connected_id']?>">Paramètres</a></li>
                    <li><a href="<?php echo "followers.php?user_id=".$_SESSION['connected_id']?>">Mes suiveurs</a></li>
                    <li><a href="<?php echo "subscriptions.php?user_id=".$_SESSION['connected_id']?>">Mes abonnements</a></li>
                </ul>
            </nav>
        </header>
