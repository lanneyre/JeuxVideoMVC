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
            $jeu = $data->fetch(PDO::FETCH_OBJ);
            $jeu->plateformes = self::getPlateformeByJeuId($jeu->Jeux_Id);
            return $jeu;
        }

        static function getGenreById($id){
            self::createConnexion();

            $sql = "SELECT * FROM `genre` WHERE `Genre_Id` = :genre_id LIMIT 1;";
            $data = self::$conn->prepare($sql);
            $data->bindValue(":genre_id", $id);
            $data->execute();
            return $data->fetch(PDO::FETCH_OBJ);
        }

        static function getPlateformeByJeuId($id){
            self::createConnexion();

            $sql = "SELECT Plateforme_Id FROM `jeuxplateforme` WHERE `Jeux_Id` = :Jeux_id;";
            $data = self::$conn->prepare($sql);
            $data->bindValue(":Jeux_id", $id);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            $allPlateformes = [];
            foreach($result as $p){
                $allPlateformes[] = $p['Plateforme_Id'];
            }
            return $allPlateformes;
        }

        static function getPlateformeById($id){
            self::createConnexion();

            $sql = "SELECT * FROM `plateforme` WHERE `Plateforme_Id` = :plateforme_id LIMIT 1;";
            $data = self::$conn->prepare($sql);
            $data->bindValue(":plateforme_id", $id);
            $data->execute();
            return $data->fetch(PDO::FETCH_OBJ);
        }

        static function createJeu($jeu){
            self::createConnexion();
            try{
                self::$conn->beginTransaction();
                $sql = "INSERT INTO `jeux` ( `Jeux_Titre`, `Jeux_Description`, `Jeux_Prix`, `Jeux_DateSortie`, `Jeux_PaysOrigine`, `Jeux_Connexion`, `Jeux_Mode`, `Genre_Id`) VALUES (:Jeux_Titre, :Jeux_Description, :Jeux_Prix, :Jeux_DateSortie, :Jeux_PaysOrigine, :Jeux_Connexion, :Jeux_Mode, :Genre_Id)";
                $req = self::$conn->prepare($sql);
                
                $req->bindValue(":Jeux_Titre", $jeu->Jeux_Titre);
                $req->bindValue(":Jeux_Description", $jeu->Jeux_Description);
                $req->bindValue(":Jeux_Prix", $jeu->Jeux_Prix);
                $req->bindValue(":Jeux_DateSortie", $jeu->Jeux_DateSortie);
                $req->bindValue(":Jeux_PaysOrigine", $jeu->Jeux_PaysOrigine);
                $req->bindValue(":Jeux_Connexion", $jeu->Jeux_Connexion);
                $req->bindValue(":Jeux_Mode", $jeu->Jeux_Mode);
                $req->bindValue(":Genre_Id", $jeu->Genre_Id, PDO::PARAM_INT);

                $req->execute();
                
                $jeu->Jeux_Id = self::$conn->lastInsertId();
                $sqlP = "INSERT INTO `jeuxplateforme` (`Jeux_Id`, `Plateforme_Id`) VALUES (:Jeux_Id, :Plateforme_Id)";
                $reqP = self::$conn->prepare($sqlP);
                foreach($jeu->plateforme as $plateforme){
                    $reqP->bindValue(":Jeux_Id", $jeu->Jeux_Id, PDO::PARAM_INT);
                    $reqP->bindValue(":Plateforme_Id", $plateforme, PDO::PARAM_INT);
                    $reqP->execute();
                }
                self::$conn->commit();
                return true;
            } catch(PDOException $e){
                self::$conn->rollBack();
                return false;
            }
        }

        static function updateJeu($jeu){
            self::createConnexion();
            try{
                self::$conn->beginTransaction();
                
                $sql = "UPDATE `jeux` SET `Jeux_Titre` = :Jeux_Titre, `Jeux_Description` = :Jeux_Description, `Jeux_Prix` = :Jeux_Prix, `Jeux_DateSortie` = :Jeux_DateSortie, `Jeux_PaysOrigine` = :Jeux_PaysOrigine, `Jeux_Connexion` = :Jeux_Connexion, `Jeux_Mode` = :Jeux_Mode, `Genre_Id` = :Genre_Id WHERE `jeux`.`Jeux_Id` = :Jeux_Id ";
                
                $req = self::$conn->prepare($sql);
                $req->bindValue(":Jeux_Id", $jeu->Jeux_Id);
                $req->bindValue(":Jeux_Titre", $jeu->Jeux_Titre);
                $req->bindValue(":Jeux_Description", $jeu->Jeux_Description);
                $req->bindValue(":Jeux_Prix", $jeu->Jeux_Prix);
                $req->bindValue(":Jeux_DateSortie", $jeu->Jeux_DateSortie);
                $req->bindValue(":Jeux_PaysOrigine", $jeu->Jeux_PaysOrigine);
                $req->bindValue(":Jeux_Connexion", $jeu->Jeux_Connexion);
                $req->bindValue(":Jeux_Mode", $jeu->Jeux_Mode);
                $req->bindValue(":Genre_Id", $jeu->Genre_Id, PDO::PARAM_INT);

                $req->execute();

                $sqlD = "DELETE FROM `jeuxplateforme` WHERE `jeuxplateforme`.`Jeux_Id` = :Jeux_Id";
                $reqD = self::$conn->prepare($sqlD);
                $reqD->bindValue(":Jeux_Id", $jeu->Jeux_Id);
                $reqD->execute();

                $sqlI = "INSERT INTO `jeuxplateforme` (`Jeux_Id`, `Plateforme_Id`) VALUES (:Jeux_Id, :Plateforme_Id)";
                $reqI = self::$conn->prepare($sqlI);

                foreach($jeu->plateforme as $p){
                    $reqI->bindValue(":Jeux_Id", $jeu->Jeux_Id);
                    $reqI->bindValue(":Plateforme_Id", $p);
                    $reqI->execute();
                }
                self::$conn->commit();
                return true;
            } catch(PDOException $e){
                self::$conn->rollBack();
                return false;
            }
        }

        static function delete($id, $table, $champ = null){
            self::createConnexion();
            try{
                if(empty($champ)){
                    $champ = $table;
                }
                $sql = "DELETE FROM `$table` WHERE `".ucfirst($champ)."_Id` = :id";
                $req = self::$conn->prepare($sql);
                $req->bindValue(":id", $id);
                // var_dump($sql);
                // var_dump(self::$conn->errorInfo() );
                return  $req->execute();
            } catch(PDOException $e){
                return false;
            }
        }
    }