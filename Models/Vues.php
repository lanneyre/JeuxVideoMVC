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
                case "insert":
                    $listing = file_get_contents("Vues/insert.tpl");
                    $listingPartTpl = file_get_contents("Vues/listing.part.tpl");
                    $listingPart = "";
                    $listingImg = "";
                    foreach($data["jeux"] as $jeu){
                        $c = str_replace("<!--Jeux_Titre-->", $jeu->Jeux_Titre, $listingPartTpl);
                        $c = str_replace("<!--Jeux_Prix-->", $jeu->Jeux_Prix, $c);
                        $c = str_replace("<!--Jeux_Id-->", $jeu->Jeux_Id, $c);
                        $listingPart .= $c;
                    }

                    $ContentView = str_replace("<!--listingPart-->", $listingPart, $listing);
                    //gestion des genres
                    $genres = [];
                    foreach($data["genres"] as $genre){
                        $genres[] = "<option value='".$genre->Genre_Id."'>".$genre->Genre_Titre."</option>";
                    }
                    $ContentView = str_replace("<!--listingGenre-->", implode("", $genres), $ContentView);
                    //gestion des plateformes
                    $plateformes = [];
                    foreach($data["plateformes"] as $plateforme){
                        $plateformes[] =<<<PLATEFORMES
                        <div class="checkbox">
                            <input type="checkbox" name="plateforme[]" id="Plateforme_$plateforme->Plateforme_Id" value="$plateforme->Plateforme_Id">
                            <label for="Plateforme_$plateforme->Plateforme_Id">$plateforme->Plateforme_Nom</label>
                        </div>
PLATEFORMES;
                    }
                    $ContentView = str_replace("<!--listingPlateforme-->", implode("", $plateformes), $ContentView);
                    break;
                case "update":
                    // var_dump($data['jeu']);
                    $listing = file_get_contents("Vues/update.tpl");
                    $listingPartTpl = file_get_contents("Vues/listing.part.tpl");
                    $listingPart = "";
                    $listingImg = "";
                    foreach($data["jeux"] as $jeu){
                        $c = str_replace("<!--Jeux_Titre-->", $jeu->Jeux_Titre, $listingPartTpl);
                        $c = str_replace("<!--Jeux_Prix-->", $jeu->Jeux_Prix, $c);
                        $c = str_replace("<!--Jeux_Id-->", $jeu->Jeux_Id, $c);
                        $listingPart .= $c;
                    }

                    $ContentView = str_replace("<!--listingPart-->", $listingPart, $listing);
                    //gestion des genres
                    $genres = [];
                    foreach($data["genres"] as $genre){
                        if($genre->Genre_Id == $data['jeu']->Genre_Id){
                            $selected = "selected='selected'";
                        } else {
                            $selected = "";
                        }

                        $genres[] = "<option value='".$genre->Genre_Id."' ".$selected.">".$genre->Genre_Titre."</option>";
                    }
                    $ContentView = str_replace("<!--listingGenre-->", implode("", $genres), $ContentView);
                    //gestion des plateformes
                    $plateformes = [];
                    foreach($data["plateformes"] as $plateforme){
                        // var_dump(in_array($plateforme->Plateforme_Id, $data['jeu']->plateformes));
                        if(in_array($plateforme->Plateforme_Id, $data['jeu']->plateformes)){
                            $checked = "checked='checked'";
                        } else {
                            $checked = "";
                        }
                        $plateformes[] =<<<PLATEFORMES
                        <div class="checkbox">
                            <input type="checkbox" name="plateforme[]" id="Plateforme_$plateforme->Plateforme_Id" value="$plateforme->Plateforme_Id" $checked>
                            <label for="Plateforme_$plateforme->Plateforme_Id">$plateforme->Plateforme_Nom</label>
                        </div>
PLATEFORMES;
                    }
                    $ContentView = str_replace("<!--listingPlateforme-->", implode("", $plateformes), $ContentView);

                    // gestion du jeu
                    $ContentView = str_replace("<!--Jeux_Id-->", $data['jeu']->Jeux_Id, $ContentView);
                    $ContentView = str_replace("<!--Jeux_Titre-->", $data['jeu']->Jeux_Titre, $ContentView);
                    $ContentView = str_replace("<!--Jeux_Description-->", $data['jeu']->Jeux_Description, $ContentView);
                    $ContentView = str_replace("<!--Jeux_Prix-->", $data['jeu']->Jeux_Prix, $ContentView);
                    $ContentView = str_replace("<!--Jeux_DateSortie-->", $data['jeu']->Jeux_DateSortie, $ContentView);
                    $ContentView = str_replace("<!--Jeux_PaysOrigine-->", $data['jeu']->Jeux_PaysOrigine, $ContentView);
                    $ContentView = str_replace("<!--Jeux_Mode-->", $data['jeu']->Jeux_Mode, $ContentView);
                    $ContentView = str_replace("<!--Jeux_Connexion-->", $data['jeu']->Jeux_Connexion, $ContentView);
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