<?php
$this->_t = 'POST';
var_dump($img);
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
				<textarea id="commentContent" name="content" placeholder="Write something..."></textarea>
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
					<div id="author">
						<p>from <span id="bottom"><?= $comment['idUser'] ?></strong></span>
					</div>
					<div class="date">
						<?= $comment['date'] ?>
					</div>
				</div>      
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
    	</div>
		<!--<span class="icon"  style=" background-image: url('../img/heart_pink.png');"></span>
		<span class="icon"  style=" background-image: url('../img/chat_small.png');"></span>
		<span class="icon" style=" background-image: url('../img/chat_blue.png');"></span>-->
	</div>
</div>


<script src="<?= URL ?>public/js/post.js"></script>
