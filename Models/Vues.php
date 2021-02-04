<?php 
    class Vues{
        
        function generateView($data, $vues = "index"){
            $template = file_get_contents("Vues/template.tpl");

            $ContentView = "";

            switch($vues){
                case "jeu":
                    $card = file_get_contents("Vues/card.tpl");
                
                    // foreach($data as $jeu){
                    $c = str_replace("<!--Jeux_Titre-->", $data->Jeux_Titre, $card);
                    $c = str_replace("<!--Jeux_Prix-->", $data->Jeux_Prix, $c);
                    $c = str_replace("<!--Jeux_Id-->", $data->Jeux_Id, $c);
                    $c = str_replace("<!--Jeux_PaysOrigine-->", $data->Jeux_PaysOrigine, $c);
                    $c = str_replace("<!--Jeux_Mode-->", $data->Jeux_Mode, $c);
                    $c = str_replace("<!--Jeux_Connexion-->", $data->Jeux_Connexion, $c);
                    $c = str_replace("<!--Jeux_DateSortie-->", $data->Jeux_DateSortie, $c);
                    $c = str_replace("<!--Jeux_Description-->", $data->Jeux_Description, $c);
    
                    $ContentView .= $c;
                    // }
                    break;
                default:
                    $listing = file_get_contents("Vues/listing.tpl");
                    $listingPartTpl = file_get_contents("Vues/listing.part.tpl");
                    $listingPart = "";
                    // $listingImgTpl = '<img src="img/<!--Jeux_Id-->.jpg" alt="Jaquette du jeu <!--Jeux_Titre-->" id="Jeux_<!--Jeux_Id-->">';
                    $listingImg = "";
                    foreach($data as $jeu){
                        $listingImgTpl = '<img src="img/<!--Jeux_Id-->.jpg" alt="Jaquette du jeu <!--Jeux_Titre-->" id="Jeux_<!--Jeux_Id-->">';
                        $c = str_replace("<!--Jeux_Titre-->", $jeu->Jeux_Titre, $listingPartTpl);
                        $c = str_replace("<!--Jeux_Prix-->", $jeu->Jeux_Prix, $c);
                        $c = str_replace("<!--Jeux_Id-->", $jeu->Jeux_Id, $c);
                        
                        $listingImgTpl = str_replace("<!--Jeux_Id-->", $jeu->Jeux_Id, $listingImgTpl);
                        $listingImgTpl = str_replace("<!--Jeux_Titre-->", $jeu->Jeux_Titre, $listingImgTpl);
                        $listingPart .= $c;
                        $listingImg .= $listingImgTpl;
                    }

                    $ContentView = str_replace("<!--listingPart-->", $listingPart, $listing);
                    $ContentView = str_replace("<!--listingImg-->", $listingImg, $ContentView);

                    break;
            }

            
            return str_replace("<!--ContentView-->", $ContentView, $template);
        }
    }