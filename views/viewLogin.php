<?php
$this->_t = 'LOGIN';
?>

<?= $msg ?>

<a href="<?= URL ?>?url=EmailForgotPasswd">FORGOT PASSWD</a>

<form method="post" action="<?=URL?>?url=login&submit=OK">
	<label for="username">Entrer votre nom d'utilisateur</label>
	<input type="text" name="username" id="username" required>
	<label for="mdp">Entrer votre mot de passe</label>
	<input type="password" name="mdp" id="mdp">
	<input type="submit" value="OK">
</form>
