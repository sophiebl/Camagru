<?php
$this->_t = 'CAMERA';
?>

	<div class="container-headline">
		<div class="headline">
			TAKE YOUR PIC HERE
		</div>
	</div>
	<div id="bodyCam">
	<form enctype="multipart/form-data" id="formPicture" style="margin-bottom:100px;" method="post" action="<?= URL ?>?url=camera&submit=OK" onSubmit="prepareImg()" enctype="multipart/form-data">
	<div class="filters">
		<img class="filter" onclick="addFilter(event)" src="<?=IMG?>air.png">
		<img class="filter" onclick="addFilter(event)" src="<?=IMG?>smokecolor.png">
		<img class="filter" onclick="addFilter(event)" src="<?=IMG?>smoken&b.png">
		<img class="filter" onclick="addFilter(event)" src="<?=IMG?>splashwater.png">
		<img class="filter" onclick="addFilter(event)" src="<?=IMG?>water.png">
	</div>
	<div class="webcam">
		<div class="preview">
			<div class="live">
				<img id="imgFilter" src="" alt="">
				<video id="video" autoplay="true"></video>
			</div>
			<div class="btn-container">
				<div class="btn-child">
					<button id="snap" onclick="takepicture()" disabled>SNAP</button>
				</div>
				<div class="btn-child">
					<button id="clear" onclick="clearFilter()">Clear</button>
				</div>
				<div class="btn-child">
					<label for="file-input">
						<span id="uploadButton">UPLOAD BUTTON</span>
					</label>
					<p id="upload">Upload</p>
					<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
					<p class="has-text-weight-semibold" id="file_name2">Aucune image</p>
					<input class="file-input" type="file" id="import_file" name="resume" accept="image/png">
				</div>
				<div class="btn-child">
					<button id="save" onclick="savePicture()">Save</button>
				</div>
				<div class="btn-child">
					<button id="retry" onclick="retrySnap()">Retry</button>
				</div>
			</div>
			<div class="more">
				<input class="input" type="text-area" placeholder="legend" name="legend" value="">
				<input type="submit" class="button is-primary" value="publier" id="publish"/>
			</div>
		</div>
		<div class="results">
			<div id="canvas-container">
				<canvas id="canvas"></canvas>
				<canvas id="canvasFilter"></canvas>
			</div>
			<canvas id='blank' style='display: none;'></canvas>
			<img src="" id="result2">
			<input type="hidden" id="result" name="result" value="">
			<input type="hidden" id="resultFilter" name="resultFilter" value="">
		</div>
	</div>
	</form>
	<script src="<?= URL ?>public/js/video.js"></script>