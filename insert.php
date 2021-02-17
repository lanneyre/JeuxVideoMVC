<?php 
    require("Models/Autoloader.php");
    Autoloader::register();

    $jeux = Jeu::getAllJeux();
    $genres = Genre::getAllGenre();
    $plateformes = Plateforme::getAllPlateforme();
    $vue = new Vues();

    echo $vue->generateView(["jeux"=>$jeux, "genres"=>$genres, "plateformes"=>$plateformes], "insert");

    // var_dump(Database::getPicachu());
