<?php
$this->_t = 'LOGIN';
?>

<h1><?= $err ?></h1>
<form method="post" action="<?=URL?>?url=login&submit=OK">
	<div>
		<label for="username">Enter your user name</label>
		<input type="text" name="username" id="username" required>
	</div>
	<br>
	<div>
		<label for="mdp" id="labelmdp">Enter your password</label>
		<input type="password" name="mdp" id="mdp">
	</div>
	<br>
	<input type="submit" value="LOGIN">
</form>
<div id="forgot">
	<a href="<?= URL ?>?url=EmailForgotPasswd">FORGOT PASSWD</a>
</div>
