<?php
$this->_t = 'GALLERY';
var_dump($images);
var_dump($user);
?>

<div class="container-headline">
<!--	<div class="headline">
	YOU POST
	</div>-->
</div>
<?php if (!isset($_SESSION['id'])): ?> 
    <h4>Log in or register to like and comment this picture</h4>
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
<?php endif; ?>


<div class="gallery-container">
	<?php if ($images): ?>
		<?php foreach($images as $img): ?>
			<?php var_dump($images); ?>
			<?php var_dump("||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||"); ?>
			<?php var_dump($img); ?>
			<div class="gallery-item">
				<img src="<?= URL.$img["path"] ?>">
				<p id="legend"><?= URL.$img["legend"]?></p>
				<div class="likes">
					<?php if (isset($_SESSION['id'])):?>
						<?php if ($isLiked): ?>
							<img id="heart" class="icon" liked src="../img/heart_pink.png" onclick="unlikePost()">
						<?php else: ?>
							<img id="heart" class="icon" unliked src="../img/heart_small.png" onclick="likePost()">
						<?php endif; ?>
					<?php else: ?>
						<a href="<?= URL ?>?url=login">
							<img id="heart" class="icon" unliked src="../img/heart_small.png" onclick="likePost()">
						</a>
					<?php endif; ?>
					<p><span id="bottom">Number of likes : <span id="likes_nb"></span></span></p>
				</div>
				<div class="user-content">

				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>

<script src="<?= URL ?>public/js/post.js"></script>
