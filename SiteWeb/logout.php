<?php

session_start();

session_destroy();
setcookie('remember', '', -1);

header('location: mes_articles.php');