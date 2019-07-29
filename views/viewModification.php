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
	<label for="email">Entrer votre nouvelle adresse email</label>
	<input type="text" name="email" id="email" value="<?= $user->getEmail() ?>">
	<br>
	<label for="username">Entrer votre nouveau nom d'utilisateur</label>
	<input type="text" name="username" id="username" value="<?= $user->getUsername() ?>">
	<br>
	<input type="submit" value="modifier votre compte">

</form>
	<!--<form onSubmit="sendModifPasswd();" method="post">-->
	<form id="formPasswd" action="<?= URL ?>?url=Modification&submit=MDP" method="post">
		<label for="password">Entrer votre mot de passe actuel</label>
		<input type="password" name="password" id="password" placeholder="Mot de passe actuel">
		<br>
		<label for="newpassword">Entrer votre nouveau mot de passe</label>
		<input type="password" name="newpassword" id="newpassword" placeholder="Nouveau mot de passe">
		<br>
		<label for="newpassword2">Retaper votre nouveau mot de passe</label>
		<input type="password" name="newpassword2" id="newpassword2" placeholder="Nouveau mot de passe">
		<br>
		<!--<label for="checkbox">Voulez-vous recevoir les notifications par email</label>
		<input type="checkbox" name="checkbox" checked>-->
		<input type="submit" value="Modifier votre mot de passe">
	</form>

<script>
/*
function sendModifPasswd()
{
	var old = document.getElementById('password').value;
	var new1 = document.getElementById('newpassword').value;
	var new2 = document.getElementById('newpassword2').value;
	var error = document.getElementById('error');
	var article_err = document.getElementById('article-err');
	var sucess = document.getElementById('success');
	var article_succ = document.getElementById('article_succ');

	event.preventDefault();
	var xhr = new XMLHttpRequest();
	xhr.responseType = 'json';
	xhr.overrideMimeType("application/json");
	xhr.open('POST', '<?=URL?>?url=Modification&submit=MDP');
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.addEventListener('readystatechange', () => {
		if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
			var res = xhr.response;
			if (res.success == 1)
			{
				success.innerHTML = '';				
				success.innerHTML = res.res;				
				aticle_err.style.display = 'none';
				article_succ.style.display = '';
			}
			else 
			{
				var output;
				error.innerHTML = '';
                error.innerHTML += res.res;
				article_err.style.display = '';
				article_succ.style.display = 'none';
			}
		}		
	});
    xhr.send(`old=${old}&new1=${new1}&new2=${new2}`);
}*/
</script>