<section class="liste">
    <!--listingPart-->
</section>
<aside class="insertJeux">
    <fieldset>
        <form action="insert.php" method="post" class="formInsert">
            <label for="Jeux_Titre">Titre</label>
            <input type="text" name="Jeux_Titre" id="Jeux_Titre" placeholder="Titre" class="form-control">
            <label for="Jeux_Description">Description</label>
            <textarea name="Jeux_Description" id="Jeux_Description" class="form-control" placeholder="Description"></textarea>
            <label for="Jeux_Prix">Prix</label>
            <input type="text" name="Jeux_Prix" id="Jeux_Prix" placeholder="Prix" class="form-control">
            <label for="Jeux_DateSortie">Date de sortie</label>
            <input type="text" name="Jeux_DateSortie" id="Jeux_DateSortie" placeholder="date de sortie" class="form-control">
            <label for="Jeux_PaysOrigine">Pays</label>
            <input type="text" name="Jeux_PaysOrigine" id="Jeux_PaysOrigine" placeholder="Pays" class="form-control">
            <label for="Jeux_Mode">Mode de jeu</label>
            <input type="text" name="Jeux_Mode" id="Jeux_Mode" placeholder="Mode de jeu" class="form-control">
            <label for="Jeux_Connexion">Connexion</label>
            <input type="text" name="Jeux_Connexion" id="Jeux_Connexion" placeholder="Connexion" class="form-control">
            <label for="Genre_Id">Genre</label>
            <select name="Genre_Id" id="Genre_Id" class="form-control">
                <option value="" disabled selected placeholder="Genre">Genre</option>
                <!--listingGenre-->
            </select>
            <label for="Genre_Id" class="allLigne">Plateformes</label>
            <!--listingPlateforme-->
        </form>
    </fieldset>
    <fieldset>
        <a href="index.php">Retour à la liste</a>
    </fieldset>
</aside>

