<?php
$this->_t = 'POST';
var_dump($img);
var_dump($user);
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
	<h1></h1>
	<img src="<?= $img["path"] ?>">
	<p id="legend"><?= $img["legend"]?></p>


	<div class="actions">
		
		<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $img['idUsers']): ?>
			<a href="<?= URL ?>?url=post&imgId=<?= $img['id'] ?>&delete=OK">
				<span class="icon" style="background-image: url('../img/trash_small.png');"></span>
			</a>
		<?php endif; ?>
		<?php //if (isset($_SESSION['id'])): ?>
			<?php// if ($isLiked): ?>
				<span id="heart" class="icon heart" style="background-image: url('../img/heart_pink.png');" onclick="unlikePost()"></span>
			<?php //else: ?>
				<span id="heart" class="icon heart" style="background-image: url('../img/heart_small.png');" onclick="likePost()"></span>
			<?php //endif; ?>
		<?php //endif; ?>
		<p><span id="bottom">Number of likes : <span id="likes_nb"><?= $img['nbLike'] ?></span></span></p>
		<!--<span class="icon"  style=" background-image: url('../img/heart_pink.png');"></span>
		<span class="icon"  style=" background-image: url('../img/chat_small.png');"></span>
		<span class="icon" style=" background-image: url('../img/chat_blue.png');"></span>-->
	</div>
</div>

</div>

<script src="<?= URL ?>public/js/post.js"></script>
