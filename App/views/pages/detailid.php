<h1>Détail annonce</h1>
<h1><?php echo $announce->title ?></h1>
<div class="card">
    <div class="content">
        <address>addresse: <?php echo $announce->city ?>, <?php echo $announce->country ?></address>
        <p>description: <?php echo $announce->description ?></p>
        <p>couchages: <?php echo $announce->nb_persons ?></p>
        <p>type: <?php echo $announce->getTypeName() ?></p>
        <p>équipements:
            <?php foreach ($Announcement_facilities as $Announcement_facilitie) : ?>
                <span><?php echo $Announcement_facilitie->Facility->name_facility ?></span>
            <?php endforeach ?>
        </p>
        <p>prix: <?php echo $announce->price ?>€/nuit</p>
        <p>appartient à: <?php echo $announce->owner->username ?></p>
        <p>
            <?php if (self::isRenter()) : ?>
        <form class="form_reserve" method="POST" novalidate class="actions">
            <div class="mb-3">
                <label class="form-label" for="begin_at">Du: </label>
                <input class="form-control" type="date" name="begin_at" id="begin_at">
            </div>
            <div class="mb-3">
                <label class="form-label" for="end_at">Au: </label>
                <input class="form-control" type="date" name="end_at" id="end_at">
            </div>
            <input id="input" class="btn btn-primary button_reserve" type="submit" value="Réserver!"></input>
        </form>
    <?php endif; ?>
    </div>
</div>