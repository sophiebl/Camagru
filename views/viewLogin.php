<?php
$this->_t = 'LOGIN';
?>

<form method="post" action="<?=URL?>?url=Login&submit=OK">
	<label for="username">Entrer votre nom d'utilisateur</label>
	<input type="text" name="username" id="username" required pattern="[A-Za-z]+">
	<label for="mdp">Entrer votre mot de passe</label>
	<input type="password" name="mdp" id="mdp">
	<input type="submit" value="OK">
</form>
