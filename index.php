<?php 
    require("Models/Autoloader.php");
    Autoloader::register();

    $jeux = Jeu::getAllJeux();
    $vue = new Vues();

    echo $vue->generateView($jeux);

    // var_dump(Database::getPicachu());
