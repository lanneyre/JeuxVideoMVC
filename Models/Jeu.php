<?php
    class Jeu{

        public function createJeu($data){
            $erreurs = [];
            foreach($data as $attribut => $valeur){
                if(!empty($valeur)){
                    if($attribut == "Jeux_DateSortie"){
                        $date = DateTime::createFromFormat('Y-m-d', $valeur);
                        if($date === false){
                            $erreurs[] = $attribut;
                        } else {
                            $this->$attribut = $valeur;
                        }
                    } else if($attribut == "Jeux_Prix"){
                        if(!is_numeric($valeur)){
                            $erreurs[] = $attribut;
                        } else {
                            $this->$attribut = $valeur;
                        }
                    } else {
                        $this->$attribut = $valeur;
                    }
                    
                } else {
                    $erreurs[] = $attribut;
                }
            }
            
            if(empty($erreurs)) {
                return true;
            } else {
                return $erreurs;
            }
        }

        public function saveJeu(){
            // $result = Database::createJeu($this);
            // if($result){
            //     return true;
            // }
            // return false;

            $bdd = Database::createJeu($this);
            $imgAutorise = ["image/jpeg"];
            $erreurs = [];
            if(!in_array($this->Jeux_Img["type"], $imgAutorise)){
                $erreurs[] = "Format d'image incorrect !";
            }
            if(isset($this->Jeux_Img["error"]) ){
                switch ($this->Jeux_Img['error']){
                    case 1: // UPLOAD_ERR_INI_SIZE
                    case 2: // UPLOAD_ERR_FORM_SIZE
                        $erreurs[] = "Image trop grande !";
                      break;
                    case 3: // UPLOAD_ERR_PARTIAL
                        $erreurs[] = "Image corrompu !";
                      break;
                    case 4: // UPLOAD_ERR_NO_FILE
                        $erreurs[] = "Pas d'image";
                      break;
                  }
            }
            if(empty($erreurs) && $bdd){
                $saveImg = Filemanager::saveimg($this);
            }
            
            
            return $saveImg && $bdd;
        }

        static function getAllJeux(){
            return Database::getAll("jeux");
        }

        function hydrate($id){
            return Database::getJeuById($id);
        }
    }