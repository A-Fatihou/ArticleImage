<?php require 'vendor/autoload.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

if (!empty($_POST)) {
    if (
        !empty($_POST['email'])
        && !empty($_POST['subject'])
        && !empty($_POST['content'])

        && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) !== false
    ) {
        // Envoyer notre email

        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->Username   = '1d7953fb42394b';
            $mail->Password   = '63a1bca28af297';
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom($_POST['email']);
            $mail->addAddress('toto@yopmail.fr');     //Add a recipient
            $mail->addReplyTo($_POST['email']);

            //Content
            $mail->Subject = $_POST['subject'];
            $mail->Body    = $_POST['content'];

            $mail->send();
        } catch (Exception $e) {
            $error = true;
        }

        $success = true;
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <!-- Incluez ici le lien vers la feuille de style Tailwind CSS -->
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

    <h1 class="text-3xl text-center text-gray-900 my-8">Contact</h1>

    <?php if (!empty($error)) : ?>
        <p class="text-center text-red-500">Une erreur est survenue</p>
    <?php endif; ?>

    <?php if (!empty($success)) : ?>
        <p class="text-center text-green-500">Votre demande a été traitée avec succès.</p>
    <?php endif; ?>

    <div class="w-full max-w-md mx-auto">
        <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Votre email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Votre email" name="email">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="subject">
                    Sujet du contact
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="subject" type="text" placeholder="Sujet du contact" name="subject">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                    Votre message
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="content" placeholder="Votre message" name="content" rows="6"></textarea>
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
