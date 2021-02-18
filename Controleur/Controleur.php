<?php
    class Controleur{
        static function default(){
            $jeux = Jeu::getAllJeux();
            $vue = new Vues();
    
            echo $vue->generateView($jeux);
        }

        static function getOne($id){
            $jeu = new Jeu();
            $jeu = $jeu->hydrate($id);
            if(empty($jeu)){
                header("Location: index.php?erreur=LejeuNexistePas");
                exit;
            }
            $vue = new Vues();

            echo $vue->generateView($jeu, "jeu");
        }

        static function delete($id){
            $jeu = new Jeu();
            $jeu->Jeux_Id = $id;
            if(empty($jeu)){
                header("Location: index.php?erreur=LejeuNexistePas");
                exit;
            }
            if($jeu->delete()){
                header("Location: index.php?deleteOk");
                exit;
            } 
            header("Location: index.php?erreur=erreurDeSuppression");
            exit;
        }

        static function insert(){
            $jeux = Jeu::getAllJeux();
            $genres = Genre::getAllGenre();
            $plateformes = Plateforme::getAllPlateforme();
            $vue = new Vues();

            echo $vue->generateView(["jeux"=>$jeux, "genres"=>$genres, "plateformes"=>$plateformes], "insert");
        }

        static function insertPOST($data, $files = []){
            unset($data['action']);
            $newJeu = new Jeu();
            $result = $newJeu->createJeu($data);
            $newJeu->Jeux_Img = $files['Jeux_Img'];
            if($result === true){
                $newJeu->saveJeu();
            }
            header("Location: index.php?page=insert");
            exit;
        }

        static function update($id){
            $jeux = Jeu::getAllJeux();
            $genres = Genre::getAllGenre();
            $plateformes = Plateforme::getAllPlateforme();
            $jeu = new Jeu();
            $jeu = $jeu->hydrate($id);
            $vue = new Vues();

            echo $vue->generateView(["jeux"=>$jeux, "genres"=>$genres, "plateformes"=>$plateformes, "jeu" => $jeu], "update");
        }

        static function updatePOST($data, $files = []){
            unset($data['action']);
            $jeuToUpdate = new Jeu();
            $result = $jeuToUpdate->createJeu($data);
            if(!empty($files['Jeux_Img']['tmp_name'])){
                $jeuToUpdate->Jeux_Img = $files['Jeux_Img'];
            } else {
                $jeuToUpdate->Jeux_Img = "img";
            }
            if($result === true){
                $jeuToUpdate->updateJeu();
            }
            header("Location: index.php?idToUpdate=".$data["Jeux_Id"]);
            exit;
            // var_dump($jeuToUpdate);
        }
    }