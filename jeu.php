<?php 
    require("Models/Autoloader.php");
    Autoloader::register();

    $jeu = new Jeu();
    $jeu = $jeu->hydrate($_GET['id']);
    if(empty($jeu)){
        header("Location: index.php?erreur=LejeuNexistePas");
        exit;
    }
    $vue = new Vues();

    echo $vue->generateView($jeu, "jeu");

    // var_dump(Database::getPicachu());
