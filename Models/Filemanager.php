<?php
    class Filemanager{

        static $pathImg = "img/";
        static $imgAutorise = ["image/jpeg"];
        
        static function saveimg($img){
            // var_dump($img);
            $tmp = explode(".", $img->Jeux_Img["name"]);
            $ext = $tmp[sizeof($tmp)-1];
            $nameFile = $img->Jeux_Id.".".$ext;
            return move_uploaded_file($img->Jeux_Img['tmp_name'], self::$pathImg.$nameFile);
        }

        static function delete($imgId){
            $contentDir = scandir(self::$pathImg);
            for ($i=0; $i < sizeof($contentDir); $i++) { 
                # code...
                if($contentDir[$i] != "." && $contentDir[$i] != ".."){
                    $tmp = explode(".", $contentDir[$i])[0];
                    if($tmp == $imgId){
                        unlink(self::$pathImg.$contentDir[$i]);
                    }
                }
            }
            return true;
        }
    }