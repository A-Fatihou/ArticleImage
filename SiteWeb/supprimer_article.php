<?php
include 'functions.php';
deny_if_not_connected();

// Ce qui vient de l'URL, je peux l'obtenir grâce aux superglobales, et notamment $_GET
$index = $_GET['index'];
$articles = get_articles();

if (empty($articles[$index])) { // On récupère notre article
    die('Erreur 404 : Page non trouvée.');
}

if (is_file($articles[$index]['image'])) {
    unlink($articles[$index]['image']);
}

unset($articles[$index]);
rewrite_bdd($articles);

// Au choix
// echo 'Article supprimé avec succès.';

header('location: mes_articles.php');
