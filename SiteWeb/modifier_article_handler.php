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

if (
    !empty($_POST['titre'])
    && !empty($_POST['contenu'])
    && !empty($_POST['auteur'])

    && !empty($_POST['date'])

    && date_create($_POST['date']) !== false

    && check_file('image', 'image/', 5_000_000)
) {
    // J'upload le fichier
    $nom = upload_file('image', 'images');

    if (is_file($articles[$index]['image'])) {
        unlink($articles[$index]['image']);
    }

    // J'ajoute l'article puis je sauvegarde
    $articles[$index] = [
        'titre' => $_POST['titre'],
        'image' => 'images/' . $nom,
        'auteur' => $_POST['auteur'],
        'contenu' => $_POST['contenu'],
        'date' => $_POST['date'],
    ];

    rewrite_bdd($articles);
    header('location: mes_articles.php');
} else {
    header('location: modifier_article.php?index=' . $index . '&error=true');
}
