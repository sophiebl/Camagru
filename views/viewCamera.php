<?php
$this->_t = 'CAMERA';
?>

<link rel="stylesheet" type="text/css" href="../css/my_style.css">
<div class="headline">
	TAKE YOUR PIC HERE
</div>

<div class="camera">
	<video id="video"></video>
	<button id="startbutton">Prendre une photo</button>
</div>
<canvas id="canvas"></canvas>
	<canvas id='blank' style='display:none'></canvas>
<div class="output">
	<img id="photo" alt="The screen capture will appear here">
</div>

<script src="<?= URL ?>public/js/video.js"></script>
<script>
	(function () {
		var width = 320;
		var height = 0;

		var streaming = false;

		var video = null;
		var canvas = null;
		var photo = null;
		var startbutton = null;

		//Startup function's job is to request access to the user's webcame
		function startup() {
			video = document.getElementById('video');
			canvas = document.getElementById('canvas');
			photo = document.getElementById('photo');
			startbutton = document.getElementById('startbutton');



			navigator.mediaDevices.getUserMedia({video: true, audio: false})
			.then(function(stream){
				video.srcObject = stream;
				video.play();
			})
			.catch(function(err){
				console.log("Error stream: " + err);
			});

			video.addEventListener('canplay', function(ev) {
				if (!streaming) {
					height = video.videoHeight / (video.videoWidth/width);

					if (isNaN(height)) {
        				height = width / (4/3);
        			}

					video.setAttribute('width', width);
					video.setAttribute('height', height);
					canvas.setAttribute('width', width);
					canvas.setAttribute('height', height);
					streaming = true;
				}				
			}, false);

			startbutton.addEventListener('click', function(ev) {
				takePicture();
				ev.preventDefault();
			}, false);

			clearPhoto();
		}

		function clearPhoto() {
			var context = canvas.getContext('2d');
			context.fillStyle = "#AAA";
			context.fillRect(0, 0, canvas.width, canvas.height);

			var data = canvas.toDataURL('image/png');
			photo.setAttribute('src', data);
		}

		function takePicture() {
			var context = canvas.getContext('2d');			
			if (width && height) {
				canvas.width = width;
				canvas.height = height;
				context.drawImage(video, 0, 0, width, height);

				var data = canvas.toDataURL('image/png');				
				photo.setAttribute('src', data);
			} else {
				clearPhoto();
			}
		}

		window.addEventListener('load', startup, false);
	})


</script>


<!--
<form id="formPicture" method="post" action="<?= URL ?>?url=camera&submit=OK" onSubmit="prepareImg()" enctype="multipart/form-data">
	<video id="video" autoplay="true"></video>
 	<canvas id="video_canvas"></canvas> 
	<canvas id="canvas"></canvas>
	<canvas id='blank' style='display:none'></canvas>
	<input id="inp_img" name="image" type="hidden" value="">
	<input type="submit" id="snap" value="OK">
	<button id="snap">Prendre une photo</button>
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
	<button class="button is-primary" id="publish" disabled>Publier</button>
</form>
<script src="<?= URL ?>public/js/video.js"></script>
 <div class="montage">
	<video id="video" autoplay="true"></video>
	<button id="takepicturebttn" onclick="takepicture()">Take picture</button>
	<div class="canvas__container">
		<canvas id="canvas" class="canvas__canvas"></canvas>
		<img src="" id="mirror" class="canvas__mirror" />
	</div>
	<button class="button" onclick="downloadPicture()">Download</button>
</div> -->

