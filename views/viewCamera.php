<!-- <script src="<?= URL ?>public/js/video.js"></script> -->
<link rel="stylesheet" type="text/css" href="../css/my_style.css">
<div class="headline">
	TAKE YOUR PIC HERE MAN
</div>

<form id="formPicture" action="<?= URL ?>?url=viewCamera&submit=OK" onSubmit="prepareImg()" enctype="multipart/form-data">
	<video id="video" autoplay="true"></video>
	<canvas id="video_canvas"></canvas>
	<canvas id="canvas"></canvas>
	<canvas id='blank' style='display:none'></canvas>
	<button id="take_pic" class="button is-primary">Prendre une photo</button>
	<div class="file">
		<input class="file-input" type="file" id="import_file" name="resume" accept="image/png">
		<span class="file-cta">
			<span class="file-icon">ICON</span>
			<span class="file-label">Choisir une image</span>
		</span>
	</div>
	<input id="inp_img" name="image" type="hidden" value="">
</form>

<script>
	function prepareImg() {
		var canvas = document.getElementById('canvas');
		var blank = document.getElementById('blank');
	console.log(canvas.toDataURL());
	console.log(blank.toDataURL());
		if (canvas.toDataURL() != blank.toDataURL())
			document.getElementById('inp_img').value = canvas.toDataURL();
	}
</script>
<!-- <div class="montage">
	<video id="video" autoplay="true"></video>
	<button id="takepicturebttn" onclick="takepicture()">Take picture</button>
	<div class="canvas__container">
		<canvas id="canvas" class="canvas__canvas"></canvas>
		<img src="" id="mirror" class="canvas__mirror" />
	</div>
	<button class="button" onclick="downloadPicture()">Download</button>
</div> -->

