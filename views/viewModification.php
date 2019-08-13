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
<form id="formNotif" action="<?= URL ?>?url=Modification&submit=Notif" method="POST">
	<div>
		<label for="checkbox">Voulez-vous recevoir les notifications par email</label>
		<input type="checkbox" name="checkbox" checked>
	</div>
	<input type="submit" value="Notif">
</form>



<form action="<?=URL?>?url=ModifUser&notif=yes" method="POST">
									<div>
										<label>
											Notification commentaire:
											<input id="inputCom" type="checkbox" name="com" value="<?=(bool)$_SESSION['user']->getNotifCom()?>">
										</label>
									</div>
									<div>
											<label>
												Notification like:
												<input id="inputLike" type="checkbox" name="like" value="<?=(bool)$_SESSION['user']->getNotifLike()?>">
											</label>
										</p>
									</div>
									<div class="field is-grouped">
										<div class="control">
											<button class="button is-primary" type="submit">Modif</button>
										</div>
									</div>
							</form>-->