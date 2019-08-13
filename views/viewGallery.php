<?php
$this->_t = 'GALLERY';
?>

<?php if (!isset($_SESSION['id'])): ?> 
    <h1>You need to log in or register to like and comment thoses pictures</h1>
<?php endif; ?>
<div class="gallery-container">
	<?php if ($images): ?>
		<?php foreach($images as $img){
			?>
			<div class="gallery-item">
				<img src="<?= URL.$img["path"] ?>">
				<p id="legend"><?= $img["legend"]?></p>
				<p id="author">By <?= $authors[$img['id']][0]['username']?></p>
				<a class="link-post" href="<?= URL ?>?url=post&imgId=<?= $img["id"] ?>">Check the post</a>
			</div>
		<?php } ?>
	<?php endif; ?>
</div>
<div class="pages">
	<?php  
		for ($page = 1; $page <= $nbPage; $page++):
			if (!isset($_GET['page']) && $page == 1): ?>
				<a id="active" href="<?= URL ?>?url=gallery&page=<?= $page ?>"><?= $page ?></a>
			<?php elseif (isset($_GET['page']) && $page == $_GET['page']):?>
				<a id="active" href="<?= URL ?>?url=gallery&page=<?= $page ?>"><?= $page ?></a>
			<?php else: ?>
				<a href="<?= URL ?>?url=gallery&page=<?= $page ?>"><?= $page ?></a>
			<?php endif;
		endfor;
	?>	
</div>

<script src="<?= URL ?>public/js/post.js"></script>
