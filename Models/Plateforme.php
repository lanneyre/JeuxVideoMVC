<?php
    class Plateforme{

        static function getAllPlateforme(){
            return Database::getAll("plateforme");
        }

        function hydrate($id){
            return Database::getPlateformeById($id);
        }
    }