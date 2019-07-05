<?php
$this->_t = 'REGISTER';
?>

<form id="formRegister" method="post">
	<label for="email">Entrer votre email</label>
	<input type="text" name="email" id="email" required>
	<label for="username">Entrer votre nom d'utilisateur</label>
	<input type="text" name="username" id="username" required>
	<label for="password">Entrer votre mot de passe</label>
	<input type="password" name="password" id="password">
	<label for="password2">Retaper votre mot de passe</label>
	<input type="password" name="password2" id="password2">
	<input type="submit" value="creer son compte">
</form>