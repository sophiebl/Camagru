<?php
$this->_t = 'MODIFICATION DE COMPTE';

//session_start();
?>

<article style="display:none;" id="article-succ" class="message is-success text-center">
<div class="message-body" id="success">
</div>
</article>
<article style="display:none;" id="article-err" class="message is-danger text-center">
<div class="message-body" id="error">
	</div>
</article>

<?= $res ?>
<?= $user->getId(); ?>
<?php var_dump($user->getNotifCom()); ?>
<form id="formModif" method="post" action="<?=URL?>?url=Modification&submit=OK">
	<div>
		<label for="email">Entrer votre nouvelle adresse email</label>
		<input type="text" name="email" id="email" value="<?= $user->getEmail() ?>">
	</div>
	<br>
	<div>
		<label for="username">Entrer votre nouveau nom d'utilisateur</label>
		<input type="text" name="username" id="username" value="<?= $user->getUsername() ?>">
	</div>
	<br>
	<div>
		<label for="checkbox">Souhaitez-vous recevoir les notifications par email</label>
		<?php if ((bool)$user->getNotifCom()) {?>
			<input type="checkbox" name="checkbox1" checked>
		<?php } else { ?>
			<input type="checkbox" name="checkbox1">
		<?php } ?>
	</div>
	<div>
		<label for="checkbox">Souhaitez-vous ne plus recevoir les notifications par email</label>
		<?php if ((bool)$user->getNotifCom()) {?>
			<input type="checkbox" name="checkbox0">
		<?php } else { ?>
			<input type="checkbox" name="checkbox0" checked>
		<?php } ?>
	</div>
	<input type="submit" value="modifier votre compte">
</form>
<form id="formPasswd" action="<?= URL ?>?url=Modification&submit=MDP" method="post">
	<div>
		<label for="password">Entrer votre mot de passe actuel</label>
		<input type="password" name="password" id="password" placeholder="Mot de passe actuel">
	</div>
	<br>
	<div>
		<label for="newpassword">Entrer votre nouveau mot de passe</label>
		<input type="password" name="newpassword" id="newpassword" placeholder="Nouveau mot de passe">
	</div>
	<br>
	<div>
		<label for="newpassword2">Retaper votre nouveau mot de passe</label>
		<input type="password" name="newpassword2" id="newpassword2" placeholder="Nouveau mot de passe">
	</div>
	<br>
	<input type="submit" value="Modifier votre mot de passe">
</form>
<!--
<form id="formNotif" action="<?=URL?>?url=Modification&notif=yes" method="POST">
	<div>
		<label for="checkbox">Voulez-vous recevoir les notifications par email</label>
		<input type="checkbox" name="checkbox" checked>
	</div>
	<input type="submit" value="Modifier votre mot de passe">
</form>-->