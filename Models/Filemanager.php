<?php
    class Filemanager{

        static $pathImg = "img/";
        
        static function saveimg($img){
            // var_dump($img);
            $tmp = explode(".", $img->Jeux_Img["name"]);
            $ext = $tmp[sizeof($tmp)-1];
            $nameFile = $img->Jeux_Id.".".$ext;
            return move_uploaded_file($img->Jeux_Img['tmp_name'], self::$pathImg.$nameFile);
        }
    }