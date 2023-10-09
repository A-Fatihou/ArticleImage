<?php
if (!empty($_POST['amount']) && is_numeric($_POST['amount'])) {
    header('location: https://paypal.me/2alheure/' . $_POST['amount']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <header class="bg-gray-800 text-white">
        <nav class="container mx-auto flex gap-4 justify-around py-4">
            <a href="mes_articles.php">Mes articles</a>
            <a href="contact.php">Contact</a>
            <a href="don.php">Don</a>

            <?php if (!empty($_SESSION['connected'])) : ?>
                <a href="ajouter_article.php">Ajouter un article</a>
                <a href="logout.php">Déconnexion</a>
            <?php else : ?>
                <a href="login.php">Connexion</a>
            <?php endif; ?>
        </nav>
    </header>

    <h1 class="text-3xl text-center text-gray-900 my-8">Don</h1>

    <?php if (!empty($error)) : ?>
        <p class="text-center text-red-500">Une erreur est survenue</p>
    <?php endif; ?>

    <?php if (!empty($success)) : ?>
        <p class="text-center text-green-500">Votre demande a été traitée avec succès.</p>
    <?php endif; ?>

    <div class="w-full max-w-md mx-auto">
        <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">
                    Montant
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="amount" type="number" name="amount" placeholder="Montant">
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
