<section class="liste">
    <!--listingPart-->
</section>
<aside class="insertJeux">
    <fieldset>
        <form action="index.php?page=update" method="post" class="formInsert" enctype="multipart/form-data">
            <label for="Jeux_Titre">Titre</label>
            <input type="text" name="Jeux_Titre" id="Jeux_Titre" placeholder="Titre" class="form-control" required value="<!--Jeux_Titre-->">
            <label for="Jeux_Description">Description</label>
            <textarea name="Jeux_Description" id="Jeux_Description" class="form-control" required placeholder="Description"><!--Jeux_Description--></textarea>
            <label for="Jeux_Prix">Prix</label>
            <input type="number" name="Jeux_Prix" id="Jeux_Prix" placeholder="Prix" class="form-control" required value="<!--Jeux_Prix-->">
            <label for="Jeux_DateSortie">Date de sortie</label>
            <input type="text" name="Jeux_DateSortie" id="Jeux_DateSortie" placeholder="date de sortie" class="form-control" required value="<!--Jeux_DateSortie-->">
            <label for="Jeux_PaysOrigine">Pays</label>
            <input type="text" name="Jeux_PaysOrigine" id="Jeux_PaysOrigine" placeholder="Pays" class="form-control" required value="<!--Jeux_PaysOrigine-->">
            <label for="Jeux_Mode">Mode de jeu</label>
            <input type="text" name="Jeux_Mode" id="Jeux_Mode" placeholder="Mode de jeu" class="form-control" required value="<!--Jeux_Mode-->">
            <label for="Jeux_Connexion">Connexion</label>
            <input type="text" name="Jeux_Connexion" id="Jeux_Connexion" placeholder="Connexion" class="form-control" required value="<!--Jeux_Connexion-->">
            <label for="Genre_Id">Genre</label>
            <select name="Genre_Id" id="Genre_Id" class="form-control" required>
                <option value="" disabled placeholder="Genre">Genre</option>
                <!--listingGenre-->
            </select>
            <label for="Genre_Id">Plateformes</label>
            <div class="PlateformesListing">
                <!--listingPlateforme-->
            </div>
            <label for="Jeux_Img"><img src="<!--Jeux_Img-->" alt="<!--Jeux_Titre-->"></label>
            <input type="file" name="Jeux_Img" id="Jeux_Img" placeholder="Image" class="form-control">
            <div class="btns">
                <input type="hidden" name="Jeux_Id" value="<!--Jeux_Id-->">
                <input type="hidden" name="action" value="update">
                <input class="btn" type="submit" value="Mettre à jour"> <input class="btn" type="reset" value="Reset">
            </div>
        </form>
    </fieldset>
    <fieldset>
        <a href="index.php">Retour à la liste</a>
    </fieldset>
</aside>

