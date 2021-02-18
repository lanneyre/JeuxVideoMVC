<?php 
    require("Models/Autoloader.php");
    Autoloader::register();

    if(!empty($_GET['id'])){
        Controleur::getOne($_GET['id']);
    } elseif(!empty($_GET['idToDelete'])){
        Controleur::delete($_GET['idToDelete']);
    } elseif(isset($_POST['action']) && $_POST['action'] == "insert"){
        Controleur::insertPOST($_POST, $_FILES);
    } elseif(!empty($_GET['page']) && $_GET['page'] == "insert"){
        Controleur::insert();
    } else {
        Controleur::default();
    }
