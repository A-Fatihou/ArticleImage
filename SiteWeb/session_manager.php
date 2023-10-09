<?php

session_start();

$identifiant = 'toto@yopmail.fr';
$mdp = '$2y$10$AL8Kt2JjyP3MQKHheCFw0e7VsDVBTRdf7XDPj/78wbun6.mMpHE0S';
$token = '$2y$10$hmOC8CLtHFEuOQp.S/262eZ7fAp.x3zXqcqC3OXKdi6FVn0.q2Uxa';


if (empty($_SESSION['connected']) && !empty($_COOKIE['remember']) && $_COOKIE['remember'] === $token) {
    $_SESSION['connected'] = true;
    setcookie('remember', $token, time() + 30 * 24 * 3600); // On crée un cookie pour un mois
}