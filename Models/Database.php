<?php
    class Database{

        static $fichierData = "jeux.json";

        static function recupJeux(){
            $data = file_get_contents(self::$fichierData);
            return json_decode($data);
        }   

        static function getJeuById($id){
            $data = self::recupJeux();
            // var_dump($data[1]->Jeux_id);
            foreach($data as $jeu){
                if($jeu->Jeux_Id == $id){
                    return $jeu;
                }
            }
            return null;
        }

        // static function getPicachu(){
        //     $data = file_get_contents("https://pokeapi.co/api/v2/pokemon/25");
        //     return $data;
        // }
    }