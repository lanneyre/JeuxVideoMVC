<?php
    class Jeu{

        static function getAllJeux(){
            return Database::recupJeux();
        }

        function hydrate($id){
            return Database::getJeuById($id);
        }
    }