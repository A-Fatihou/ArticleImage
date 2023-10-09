<?php
include 'session_manager.php';

// Ce qui vient de l'URL, je peux l'obtenir grâce aux superglobales, et notamment $_GET
$index = $_GET['index'];
$articles = json_decode(file_get_contents('bdd.json'), true);

if (empty($articles[$index])) { // On récupère notre article
    die('Erreur 404 : Page non trouvée.');
} else {
    $article = $articles[$index];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article['titre'] ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <header class="bg-gray-800 text-white">
        <nav class="container mx-auto flex gap-4 justify-around py-4">
            <a href="mes_articles.php">Mes articles</a>
            <a href="contact.php">Contact</a>
            
            <?php if (!empty($_SESSION['connected'])) : ?>
                <a href="ajouter_article.php">Ajouter un article</a>
                <a href="logout.php">Déconnexion</a>
            <?php else : ?>
                <a href="login.php">Connexion</a>
            <?php endif; ?>
        </nav>
    </header>

    <div class="flex gap-4">

        <div class="w-1/4 text-center p-16">
            <p>Auteur : <?= $article['auteur'] ?></p>
            <p>Date : <?= date_create($article['date'])->format('d/m/Y') ?></p>
        </div>

        <div class="w-3/4">
            <img src="<?= $article['image'] ?>" class="w-full object-cover" alt="">
            <h1 class="text-center text-bold text-lg my-8"><?= $article['titre'] ?></h1>

            <p><?= $article['contenu'] ?></p>
        </div>

    </div>

</body>

</html>