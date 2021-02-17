<?php
    class Jeu{

        static function getAllJeux(){
            return Database::getAll("jeux");
        }

        function hydrate($id){
            return Database::getJeuById($id);
        }
    }