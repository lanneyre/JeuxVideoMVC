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
    } elseif(isset($_POST['action']) && $_POST['action'] == "update"){
        Controleur::updatePOST($_POST);
    } elseif(!empty($_GET['idToUpdate'])){
        Controleur::update($_GET['idToUpdate']);
    }else {
        Controleur::default();
    }
