<?php
$this->_t = 'MODIFICATION DE COMPTE';

//session_start();
?>

<?= $user->getId(); ?>
<form id="formModif" method="post" action="<?=URL?>?url=Modification&submit=OK">
	<label for="email">Entrer votre nouvelle adresse email</label>
	<input type="text" name="email" id="email" value="<?= $user->getEmail() ?>">
	<label for="username">Entrer votre nouveau nom d'utilisateur</label>
	<input type="text" name="username" id="username" value="<?= $user->getUsername() ?>">
	<input type="submit" value="modifier votre compte">

</form>
<form action="<?= URL ?>?url=Modification&submit=MDP">
	<label for="password">Entrer votre mot de passe actuel</label>
	<input type="password" name="password" id="password">
	<label for="newpassword">Entrer votre nouveau mot de passe</label>
	<input type="password" name="newpassword" id="newpassword">
	<label for="newpassword2">Retaper votre nouveau mot de passe</label>
	<input type="password" name="newpassword2" id="newpassword2">
	<label for="checkbox">Voulez-vous recevoir les notifications par email</label>
	<input type="checkbox" name="checkbox" checked>
	<input type="submit" value="Modifier votre mot de passe">
</form>