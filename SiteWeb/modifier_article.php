<?php

include 'functions.php';
include 'session_manager.php';
deny_if_not_connected();

// Ce qui vient de l'URL, je peux l'obtenir grâce aux superglobales, et notamment $_GET
if (empty($_GET['index'])) {
    die('Erreur 404 : Page non trouvée.');
}

$index = $_GET['index'];
$articles = get_articles();

if (empty($articles[$index])) { // On récupère notre article
    die('Erreur 404 : Page non trouvée.');
}

$titre = 'Modifier un article';
$article = $articles[$index];
$action = 'modifier_article_handler.php?index=' . $index;

include 'formulaire.php';
