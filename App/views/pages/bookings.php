<h1>Mes reservations : </h1>
<div class="card_container">
    <?php foreach ($bookings as $booking) : ?>

        <div class="card">
            
                <div class="content">
                    <p>Début: <?php echo $booking['début'] ?></p>
                    <p>Fin: <?php echo $booking['fin'] ?></p>
                    <p>Propriétaire: <?php echo $booking['propriétaire'] ?></p>
                </div>
           
        </div>

    <?php endforeach; ?>
</div>