<?php 
    require("Models/Autoloader.php");
    Autoloader::register();

    if(!empty($_GET['id'])){
        $jeu = new Jeu();
        $jeu = $jeu->hydrate($_GET['id']);
        if(empty($jeu)){
            header("Location: index.php?erreur=LejeuNexistePas");
            exit;
        }
        $vue = new Vues();

        echo $vue->generateView($jeu, "jeu");
    } else {
        $jeux = Jeu::getAllJeux();
        $vue = new Vues();

        echo $vue->generateView($jeux);
    }
    

    // var_dump(Database::getPicachu());
