<?php

/**
 * Récupère la BDD
 */
function get_articles(): array {
    return json_decode(file_get_contents('bdd.json'), true);
}

/**
 * Met à jour la BDD
 */
function rewrite_bdd($articles) {
    $json = json_encode($articles, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    file_put_contents('bdd.json', $json);
}

/** 
 * Vérifie un fichier 
 */
function check_file(string $name, string $type, int $max_size): bool {
    return !empty($_FILES[$name])
        && $_FILES[$name]['error'] == 0
        && $_FILES[$name]['size'] <= $max_size
        && str_starts_with($_FILES[$name]['type'], $type);


    if (
        !empty($_FILES[$name])
        && $_FILES[$name]['error'] == 0
        && $_FILES[$name]['size'] <= $max_size
        && str_starts_with($_FILES[$name]['type'], $type)
    ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Upload un fichier
 */
function upload_file(string $name, string $dossier): string {
    $nom = uniqid();
    $extension = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);

    $nom_complet = $nom . '.' . $extension;

    if (!is_dir($dossier)) {
        mkdir($dossier);
    }

    move_uploaded_file($_FILES[$name]['tmp_name'], $dossier . '/' . $nom_complet);

    return $nom_complet;
}

/**
 * Check si l'utilisateur est connecté
 */
function is_connected() {
    return !empty($_SESSION['connected']);
}

/**
 * Dégager l'utilisateur s'il n'est pas connecté
 */
function deny_if_not_connected() {
    if (!is_connected()) {
        die('Erreur 403 : Accès refusé !');
    }
}