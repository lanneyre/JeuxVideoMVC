<?php 
    require("Models/Autoloader.php");
    Autoloader::register();

    if(isset($_POST['action']) && $_POST['action'] == "insert"){
        unset($_POST['action']);
        $newJeu = new Jeu();
        $result = $newJeu->createJeu($_POST);
        $newJeu->Jeux_Img = $_FILES['Jeux_Img'];
        if($result === true){
            $newJeu->saveJeu();
        }
        var_dump($result);
    }

    $jeux = Jeu::getAllJeux();
    $genres = Genre::getAllGenre();
    $plateformes = Plateforme::getAllPlateforme();
    $vue = new Vues();

    echo $vue->generateView(["jeux"=>$jeux, "genres"=>$genres, "plateformes"=>$plateformes], "insert");

    // var_dump(Database::getPicachu());
