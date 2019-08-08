<?php
$this->_t = 'GALLERY';
//	var_dump($images);
//var_dump($allUsers);
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
		<?php foreach($images as $img){
			?>
			<div class="gallery-item">
				<img src="<?= URL.$img["path"] ?>">
				<p id="legend"><?= $img["legend"]?></p>
				<p id="author">By <?= $img_author["author"]?></p>
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
