<?php

include 'functions.php';
include 'session_manager.php';
deny_if_not_connected();

$titre = 'Ajouter un article';
$action = 'ajouter_article_handler.php';

include 'formulaire.php';