<h1>Créér une annonce:</h1>
<form class="form_create_announce" method="POST" novalidate class="actions">

    <div class="mb-3">
        <input class="form-control" type="text" name="title" placeholder="titre">
    </div>
    <div class="mb-3">
        <input class="form-control" type="number" name="price" id="price" placeholder="prix d'une nuit">
        <input class="form-control" type="number" name="nb_persons" id="nb_persons" placeholder="nombre de couchages">
    </div>
    <div class="mb-3">
        <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="description"></textarea>
    </div>
    <div class="mb-3">
        <input class="form-control" type="text" name="city" id="city" placeholder="Ville">
        <input class="form-control" type="text" name="country" id="country" placeholder="Pays">
    </div>

    <div class="mb-3">
        <label class="form-label" for="Logement entier">Logement entier</label>
        <input type="radio" name="rent_type" value="0" id="Logement entier">
        <label class="form-label" for="Chambre privée">Chambre privée</label>
        <input type="radio" name="rent_type" value="1" id="Chambre privée">
        <label class="form-label" for="Chambre partagée">Chambre partagée</label>
        <input type="radio" name="rent_type" value="2" id="Chambre partagée">
    </div>
    <div>
        <input type="checkbox" value="okPet" name="okPet" id="okPet">
        <label for="okPet">animaux acceptés</label>
        <input type="checkbox" value="cafetière" name="cafetière" id="cafetière">
        <label for="cafetière">cafetière</label>
        <input type="checkbox" value="washing-machine" name="washing-machine" id="washing-machine">
        <label for="washing-machine">machine a laver</label>
        <input type="checkbox" value="grille-pain" name="grille-pain" id="grille-pain">
        <label for="grille-pain">grille-pain</label>
        <input type="checkbox" value="micro-onde" name="micro-onde" id="micro-onde">
        <label for="micro-onde">micro-onde</label>
        <input type="checkbox" name="box-internet" id="box-internet" value="box-internet">
        <label for="box-internet">box-internet</label>


    </div>
    <input class="btn btn-primary" id="input" type="submit" value="Crééz mon annonce">
</form>