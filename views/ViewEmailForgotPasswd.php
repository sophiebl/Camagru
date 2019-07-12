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

<form action="<?=URl?>?url=EmailForgotPasswd&submit=OK" method="post">
	<input type="email" placeholder="email" name="email" required>
	<button type="submit"></button>
</form>