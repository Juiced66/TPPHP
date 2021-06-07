<!doctype html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $html_title ?></title>
	
</head>

<body>
	<header class="header">
		<div>
			<a href="/">Acceuil</a>
				<?php if (self::isAuth()) : ?>
					<span >Bonjour, <?php echo self::authUser()->username ?></span> <a href="/deconnexion">Se déconnecter</a>
				<?php else : ?>
					<a href="/login">Se connecter</a>
					<a href="/inscription">S'inscrire</a>
				<?php endif; ?>
		

		</div>
		<nav>
			<ul>
				<?php if (self::isAnnouncer()) : ?>
					<li><a href="/create-announcement">Creez une annonce</a></li>
					<li><a href="/announcer-bookings">Réservations enregistrée</a></li>
					<li><a href="/my-announcements">Mes annonces</a></li>
				<?php elseif (self::isRenter()) : ?>
					<li><a href="/bookings">Réservations</a></li>
				<?php endif; ?>
				<li><a href="/announcements">Annonce</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<!-- Your common content here -->
