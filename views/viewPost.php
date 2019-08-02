<?php
$this->_t = 'POST';
?>

<div>
<div class="container-headline">
	<div class="headline">
	YOU POST
	</div>
<?php if (!isset($_SESSION['id'])): ?> 
    <h4>Log in or register to like and comment this picture</h4>
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
<?php endif; ?>


<div class="post-container">
	<h1><?= $user->getUsername(); ?></h1>
	<img src="<?= $img["path"] ?>">
	<p id="legend"><?= $img["legend"]?></p>


	<div class="actions">
		<span class="icon" style="background-image: url('../img/heart_small.png');"></span>
		<!--<span class="icon"  style=" background-image: url('../img/heart_pink.png');"></span>
		<span class="icon"  style=" background-image: url('../img/chat_small.png');"></span>
		<span class="icon" style=" background-image: url('../img/chat_blue.png');"></span>-->
	</div>
	<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $img['idUsers']): ?>
		<a href="<?= URL ?>?url=post&idImg=<?= $img['id'] ?>&delete=OK">
			<span class="icon" style="background-image: url('../img/trash_small.png');"></span>
		</a>
	<?php endif; ?>
	<?php if (isset($_SESSION['user'])): ?>
		<?php if ($liked_or_not): ?>
		<i id="heart" class="fas fa-heart fa-3x" onclick="unlikePost()"></i>
		<?php else: ?>
		<i id="heart" class="far fa-heart fa-3x" onclick="likePost()"></i>
		<?php endif; ?>
	<?php endif; ?>
	<p><span id="bottom">Number of likes : <span id="likes_number"><?= strval($nb_likes) ?></span></span></p>
	<p><span id="bottom">Number of comments : <span id="comments_number"><?= count($comments) ?></span></span></p>
</div>

</div>