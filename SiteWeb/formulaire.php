<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
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

    <h1 class="text-center text-bold text-lg my-8"><?= $titre ?></h1>

    <?php if (!empty($_GET['error'])) : ?>
        <p class="border border-red-500 rounded p-4 text-red-500 w-full max-w-md mb-8 mx-auto">Une erreur est survenue. Veuillez réessayer.</p>
    <?php endif; ?>

    <div class="w-full max-w-md mx-auto">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="<?= $action ?>" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="titre">
                    Titre
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="titre" type="text" placeholder="titre" name="titre" value="<?= $article['titre'] ?? null ?>">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="auteur">
                    Auteur
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="auteur" type="text" placeholder="auteur" name="auteur" value="<?= $article['auteur'] ?? null ?>">
            </div>

            <div class="mb-6 flex gap-4">
                <div class="grow">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        Image
                    </label>
                    <input class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="image" type="file" placeholder="image" name="image">
                </div>

                <?php if (!empty($article['image'])) : ?>
                    <img src="<?= $article['image'] ?>" alt="" class="w-24 h-24 object-contain">
                <?php endif; ?>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Date
                </label>
                <input class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="date" type="date" placeholder="date" name="date" value="<?= $article['date'] ?? null ?>">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="contenu">
                    Contenu
                </label>
                <textarea class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="contenu" type="contenu" placeholder="contenu" name="contenu"><?= $article['contenu'] ?? null ?></textarea>
            </div>

            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Envoyer
                </button>
            </div>
        </form>
    </div>
</body>

</html>