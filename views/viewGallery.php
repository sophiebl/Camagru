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
<div class="gallery-container" style="margin-bottom: 200px;">
	<?php if ($images): ?>
		<?php foreach($images as $img){
			?>
			<div class="gallery-item">
				<img src="<?= URL.$img["path"] ?>">
				<a href="<?= URL ?>?url=post&imgId=<?= $img["id"] ?>">Check the post</a>
				<p id="legend"><?= $img["legend"]?></p>
				<p id="author"><?= $img["idUsers"]?></p>
			</div>
		<?php } ?>
	<?php endif; ?>
</div>

<script src="<?= URL ?>public/js/post.js"></script>
