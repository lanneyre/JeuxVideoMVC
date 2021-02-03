<?php
    class Database{

        static $fichierData = "jeux.json";

        static function getAllJeux(){
            $data = file_get_contents(self::$fichierData);
            return json_decode($data);
        }   

        // static function getPicachu(){
        //     $data = file_get_contents("https://pokeapi.co/api/v2/pokemon/25");
        //     return $data;
        // }
    }