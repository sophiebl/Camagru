<?php
$this->_t = 'POST';
?>

<?php if (!isset($_SESSION['id'])): ?> 
    <h1>You need to log in or register to like and comment thoses pictures</h1>
<?php endif; ?>
<div class="post-container">
	<img src="<?= URL.$img["path"] ?>">
	<p id="legend"><?= $img["legend"]?></p>
	<p>Picture take by <?= $authorImg?></p>
	<div class="actions">
		<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $img['idUsers']): ?>
			<a href="<?= URL ?>?url=post&imgId=<?= $img['id'] ?>&delete=OK">
				<span class="icon" style="background-image: url('../img/trash_small.png');"></span>
			</a>
		<?php endif; ?>
		<?php if (isset($_SESSION['id'])):
			?>
			<?php if ($isLiked): ?>
				<img id="heart" class="icon" liked src="../img/heart_pink.png" onclick="unlikePost()">
			<?php else: ?>
				<img id="heart" class="icon" unliked src="../img/heart_small.png" onclick="likePost()">
			<?php endif; ?>
		<?php endif; ?>
		<p><span id="bottom">Number of likes : <span id="likes_nb"><?= $nbLike ?></span></span></p>
		<div class="comment-container">
		<?php if (isset($_SESSION['id'])): ?>
			<form>
				<textarea id="commentContent" name="content" placeholder="Write your comment here..."></textarea>
				<br>
				<button type="button" onclick="leaveComment('<?= $_SESSION['id'] ?>')">Send a comment</button>
			</form>
		<?php endif; ?>
		<?php if ($comments): ?>
			<p id="title">All comments about this picture</p>
			<div class="comment-item">
				<?php foreach($comments as $comment): ?>
				<div>
					<p id="content"><?= $comment['content'] ?></p>
					<div id="author" class="date">
						from <span id="bottom"><?= $comment['IdUser'] ?></span> the <span><?= $comment['date'] ?></span> 
					</div>
				</div>      
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
    	</div>
	</div>
</div>
<script src="<?= URL ?>public/js/post.js"></script>
