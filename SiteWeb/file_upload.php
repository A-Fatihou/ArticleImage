<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    if (!empty($_FILES)) {
        var_dump($_FILES);

        if (
            empty($_FILES['toto'])
            || $_FILES['toto']['error'] !== 0
            || $_FILES['toto']['type'] !== 'application/pdf'
            || $_FILES['toto']['size'] > 5_000_000
        ) {
            die('Error');
        }

        $nom = uniqid();
        $extension = pathinfo($_FILES['toto']['name'], PATHINFO_EXTENSION);

        $nom_complet = $nom . '.' . $extension;

        $dossier = 'images';

        if (!is_dir($dossier)) {
            mkdir($dossier);
        }

        move_uploaded_file($_FILES['toto']['tmp_name'], $dossier . '/' . $nom_complet);
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input id="max_id" type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        <input type="file" name="toto" id="" accept="application/pdf">
        <input type="submit" value="Envoyer">
    </form>

    <p>Formats acceptés : PDF. Taille max : 5Mo.</p>

</body>

</html>