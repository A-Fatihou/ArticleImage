<?php

include 'session_manager.php';
include 'functions.php';
deny_if_not_connected();

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

    $articles = get_articles();
    $articles[] = [
        'titre' => $_POST['titre'],
        'image' => 'images/' . $nom,
        'auteur' => $_POST['auteur'],
        'contenu' => $_POST['contenu'],
        'date' => $_POST['date'],
    ];

    rewrite_bdd($articles);
    header('location: mes_articles.php');
} else {
    header('location: ajouter_article.php?error=true');
}
