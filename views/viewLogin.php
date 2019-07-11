<?php
$this->_t = 'LOGIN';
?>

<?= $msg ?>

<form method="post" action="<?=URL?>?url=login&submit=OK">
	<label for="username">Entrer votre nom d'utilisateur</label>
	<input type="text" name="username" id="username" required>
	<label for="mdp">Entrer votre mot de passe</label>
	<input type="password" name="mdp" id="mdp">
	<input type="submit" value="OK">
</form>
