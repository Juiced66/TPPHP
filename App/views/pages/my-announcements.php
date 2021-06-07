<h1>Nos Annonces:</h1>
<div class="card_container">
    <?php foreach ($announcements as $announcement) : ?>

        <div class="card">
            <a href="/catalogue/<?php echo $announcement->id ?>">
                <div class="content">
                    <h3><?php echo $announcement->title ?></h3>
                    <address>addresse: <?php echo $announcement->city ?>, <?php echo $announcement->country ?></address>
                    <p>description: <?php echo $announcement->description ?></p>
                    <p>couchages: <?php echo $announcement->nb_persons ?></p>
                    <p>type: <?php echo $announcement->getTypeName() ?></p>
                    <p>prix: <?php echo $announcement->price ?>€/nuit</p>
                </div>
            </a>
        </div>

    <?php endforeach; ?>
</div>