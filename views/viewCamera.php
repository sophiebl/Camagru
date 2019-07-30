<?php
$this->_t = 'CAMERA';
?>

<link rel="stylesheet" type="text/css" href="../css/my_style.css">
<div class="container-headline">
	<div class="headline">
	TAKE YOUR PIC HERE
	</div>
</div>
<!--
<div class="filters">
	<img onclick="addFilter(event)" src="<?=IMG?>mortarboard.png">
	<img onclick="addFilter(event)" src="<?=IMG?>webcam.png">
</div>
<video id="video" autoplay="true"></video>
<div id="canvas-container">
	<canvas id="canvas"></canvas>
	<canvas id="canvasFilter"></canvas>
</div>
<div class="btn-container">
	<div class="btn-child">
		<button id="snap" onclick="snapPic()">SNAP</button>
	</div>
	<div class="btn-child">
		<button id="clear" onclick="clearFilter()">Clear</button>
	</div>
	<div class="btn-child">
		<p id="upload">Upload</p>
		<input type="file" id="file-input" style="display: none;" accept=".png">
	</div>
	<div class="btn-child">
		<button id="save" onclick="savePic()">Save</button>
	</div>
	<div class="btn-child">
		<button id="retry" onclick="retrySnap()">Retry</button>
	</div>
</div>
<script src="<?= URL ?>public/js/video.js"></script>
-->















































<form id="formPicture" method="post" action="<?= URL ?>?url=camera&submit=OK" onSubmit="prepareImg()" enctype="multipart/form-data">
	<video id="video" autoplay="true"></video>
	<div id="canvas-container">
		<canvas id="canvas"></canvas>
		<canvas id="canvasFilter"></canvas>
	</div>
	<canvas id='blank'></canvas>
	<input id="inp_img" name="image" type="hidden" value="">
	<button id="snap" onclick="takepicture()" disabled>Prendre une photo</button>
	<img onclick="addFilter(event)" src="<?=IMG?>mortarboard.png">
	<img onclick="addFilter(event)" src="<?=IMG?>webcam.png">
	<!--<input id="inp_img" name="image" type="" value="">
	<p id="imgPath">Aucune image</p>
	<i id="trash"></i>
	<span class="file-name" id="file_name">
			Aucune image importée
		</span>
	<input class="input" type="text-area" placeholder="legend" name="legend" value="">
	<button class="button is-primary" id="publish" disabled>Publier</button>-->
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
			<input type="text" id="image" name="image" value="">
			<!--<p class="has-text-weight-semibold" id="imgPath">Aucune image</p>-->
		</div>
		<div class="column is-10">
			<i class="fas fa-trash" id="trash"></i>
		</div>
	</div>
	<input class="input" type="text-area" placeholder="legend" name="legend" value="">
	<button class="button is-primary" id="publish" disabled>Publier</button>
</form>
<script src="<?= URL ?>public/js/video.js"></script>

<script>

function prepareImg() {
	var canvas = document.getElementById('canvas');
	var blank = document.getElementById('blank');

	if (canvas.toDataURL() != blank.toDataURL())
		document.getElementById('inp_img').value = canvas.toDataURL();
	}
</script>
<!--
 <div class="montage">
	<video id="video" autoplay="true"></video>
	<button id="takepicturebttn" onclick="takePicture()">Take picture</button>
	<div class="canvas__container">
		<canvas id="canvas" class="canvas__canvas"></canvas>
		<img src="" id="mirror" class="canvas__mirror" />
	</div>
	<button class="button" onclick="downloadPicture()">Download</button>
</div>--> 
