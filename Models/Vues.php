<?php 
    class Vues{
        
        function generateView($data, $vues = "index"){
            $template = file_get_contents("Vues/template.tpl");

            $card = file_get_contents("Vues/card.tpl");
            $cards = "";
            foreach($data as $jeu){
                $c = str_replace("<!--Jeux_Titre-->", $jeu->Jeux_Titre, $card);
                $c = str_replace("<!--Jeux_Prix-->", $jeu->Jeux_Prix, $c);
                $c = str_replace("<!--Jeux_Id-->", $jeu->Jeux_Id, $c);
                $c = str_replace("<!--Jeux_PaysOrigine-->", $jeu->Jeux_PaysOrigine, $c);
                $c = str_replace("<!--Jeux_Mode-->", $jeu->Jeux_Mode, $c);
                $c = str_replace("<!--Jeux_Connexion-->", $jeu->Jeux_Connexion, $c);
                $c = str_replace("<!--Jeux_DateSortie-->", $jeu->Jeux_DateSortie, $c);
                $c = str_replace("<!--Jeux_Description-->", $jeu->Jeux_Description, $c);

                $cards .= $c;
            }
            return str_replace("<!--ContentView-->", $cards, $template);
        }
    }