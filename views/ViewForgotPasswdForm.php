<?php
$this->_t = 'Camagru';
?>

<?php
    session_start();
    var_dump($_SESSION['id']);
	//die();
	?>
<h1>FORGOT PASSWD</h1>
<a href="<?= URL ?>?url=register">REGISTER</a>
<a href="<?= URL ?>?url=modification">MODIFICATION</a>
<a href="<?= URL ?>?url=logout">DECONNEXION</a>
<?php if ($msg)
{
	echo $msg;
} if ($err)
{
	echo $err;
}	?>

<form id="formPasswd" action="<?= URL ?>?url=forgotPasswdForm&submit=OK" method="post">
	<label for="newpassword">Entrer votre nouveau mot de passe</label>
	<input type="password" name="newpassword" id="newpassword" placeholder="Nouveau mot de passe">
	<label for="newpassword2">Retaper votre nouveau mot de passe</label>
	<input type="password" name="newpassword2" id="newpassword2" placeholder="Nouveau mot de passe">
	<input type="submit" value="Modifier votre mot de passe">
</form>