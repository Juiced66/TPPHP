<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Connexion - Occazz.com</title>
</head>
<body>
	<h1>Connexion</h1>

	<?php if( isset( $error )): ?>
		<div>
			Erreur: <?php echo $error ?>
		</div>
	<?php endif; ?>

	<form method="post" action="" novalidate>
		<input type="email" name="email" placeholder="Votre E-Mail"><br>
		<input type="password" name="password" placeholder="Mot de passe"><br>
		<input type="submit" value="Connexion">
	</form>
</body>
</html>
