<?php
$this->_t = 'CAMERA';
?>

<link rel="stylesheet" type="text/css" href="../css/my_style.css">
<div class="headline">
	TAKE YOUR PIC HERE
</div>

<form id="formPicture" method="post" action="<?= URL ?>?url=camera&submit=OK" onSubmit="prepareImg()" enctype="multipart/form-data">
	<video id="video" autoplay="true"></video>
<!-- 	<canvas id="video_canvas"></canvas> -->
	<canvas id="canvas"></canvas>
	<canvas id='blank' style='display:none'></canvas>
	<input type="submit" id="snap" value="OK">
	<!--<button id="snap">Prendre une photo</button>
	<div class="file">
		<input class="file-input" type="file" id="import_file" name="resume" accept="image/png">
		<span class="file-cta">
			<span class="file-icon">ICON</span>
			<span class="file-label">Choisir une image</span>
		</span>
		<span class="file-name" id="file_name">
			Aucune image importée
		</span>
	</div>
	<input id="inp_img" name="image" type="" value="">
	<div class="columns">
		<div class="column">
			<p class="has-text-weight-semibold" id="file_name2">Aucune image</p>
		</div>
		<div class="column is-10">
			<i class="fas fa-trash" id="trash"></i>
		</div>
	</div>
	<input class="input" type="text-area" placeholder="Description" name="description" value="">
	<button class="button is-primary" id="publish" disabled>Publier</button>-->
</form>
<script src="<?= URL ?>public/js/video.js"></script>
<!-- <div class="montage">
	<video id="video" autoplay="true"></video>
	<button id="takepicturebttn" onclick="takepicture()">Take picture</button>
	<div class="canvas__container">
		<canvas id="canvas" class="canvas__canvas"></canvas>
		<img src="" id="mirror" class="canvas__mirror" />
	</div>
	<button class="button" onclick="downloadPicture()">Download</button>
</div> -->

