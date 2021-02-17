<?php
    class Database{

        static $hostname = "localhost";
        static $dbname = "jeuxvideo";
        static $userdb = "root";
        static $mdpdb = "";
        static $driverdb = "mysql";

        static $conn;

        static function createConnexion(){
            if(empty(self::$conn)){
                self::$conn = new PDO(self::$driverdb.":host=".self::$hostname.";dbname=".self::$dbname, self::$userdb, self::$mdpdb);
            }
        }

        // static $fichierData = "jeux.json";

        static function recupJeux(){
            self::createConnexion();

            $sql = "SELECT * FROM `jeux`";
            $data = self::$conn->query($sql);
            return $data->fetchAll(PDO::FETCH_OBJ);
            //$data = file_get_contents(self::$fichierData);
            //return json_decode($data);
        }   

        static function getAll($table){
            self::createConnexion();

            $sql = "SELECT * FROM `".$table."`";
            $data = self::$conn->query($sql);
            return $data->fetchAll(PDO::FETCH_OBJ);
        }

        static function getJeuById($id){
            self::createConnexion();

            $sql = "SELECT * FROM `jeux` WHERE `Jeux_Id` = :jeux_id LIMIT 1;";
            $data = self::$conn->prepare($sql);
            $data->bindValue(":jeux_id", $id);
            $data->execute();
            return $data->fetch(PDO::FETCH_OBJ);
            
            // $data = self::recupJeux();
            // // var_dump($data[1]->Jeux_id);
            // foreach($data as $jeu){
            //     if($jeu->Jeux_Id == $id){
            //         return $jeu;
            //     }
            // }
            // return null;
        }

        static function getGenreById($id){
            self::createConnexion();

            $sql = "SELECT * FROM `genre` WHERE `Genre_Id` = :genre_id LIMIT 1;";
            $data = self::$conn->prepare($sql);
            $data->bindValue(":genre_id", $id);
            $data->execute();
            return $data->fetch(PDO::FETCH_OBJ);
        }

        static function getPlateformeById($id){
            self::createConnexion();

            $sql = "SELECT * FROM `plateforme` WHERE `Plateforme_Id` = :plateforme_id LIMIT 1;";
            $data = self::$conn->prepare($sql);
            $data->bindValue(":plateforme_id", $id);
            $data->execute();
            return $data->fetch(PDO::FETCH_OBJ);
        }

        // static function getPicachu(){
        //     $data = file_get_contents("https://pokeapi.co/api/v2/pokemon/25");
        //     return $data;
        // }
    }