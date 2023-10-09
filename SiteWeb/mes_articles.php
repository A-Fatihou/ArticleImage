<?php include 'session_manager.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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

    <h1 class="text-center text-bold text-lg my-8">Mes articles</h1>

    <?php if (!empty($_SESSION['connected'])) : ?>
        <p class="text-center my-8">
            <a href="ajouter_article.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300">
                <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                Créer un article
            </a>
        </p>
    <?php endif; ?>

    <div class="grid grid-cols-3 gap-8 mx-auto container items-center mb-8">
        <?php $articles = json_decode(file_get_contents('bdd.json'), true);

        foreach ($articles as $index => $a) : ?>
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow h-full flex flex-col">
                <a href="details_article.php?index=<?php echo $index; ?>">
                    <img class="rounded-t-lg h-48 w-full object-cover" src="<?php echo $a['image']; ?>" alt="" />
                </a>
                <div class="p-5 flex flex-col grow">
                    <a href="details_article.php?index=<?php echo $index; ?>">
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?php echo $a['titre']; ?></h2>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 mb-auto"><?php echo substr($a['contenu'], 0, 200); ?>...</p>

                    <div class="flex gap-4 mt-4">
                        <a href="details_article.php?index=<?php echo $index; ?>" class="mr-auto inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Lire plus
                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                        
                        <?php if (!empty($_SESSION['connected'])) : ?>
                            <a href="modifier_article.php?index=<?php echo $index; ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-500 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>

                            <a href="supprimer_article.php?index=<?php echo $index; ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</body>

</html>