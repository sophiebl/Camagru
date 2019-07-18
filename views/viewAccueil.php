<?php
$this->_t = 'Camagru';
foreach($articles as $article): ?>
<h2><?= $article->getTitle() ?></h2>
<time><?= $article->getDate() ?></time>
<?php endforeach; ?>


<?php
    session_start();
    var_dump($_SESSION['id']);
	//die();
	?>
<h1>PAGE D'ACCUEIL</h1>
<?= $msg ?>
<!--
<link rel="stylesheet" type="text/css" href="../public/css/video.css">

<a href="<?= URL ?>?url=camera">CAMERA</a>
<div class="montage">
	<video id="video" autoplay="true"></video>
	<button id="takepicturebttn" onclick="takepicture()">Take picture</button>
		<div class="canvas__container">
			<canvas id="canvas" class="canvas__canvas"></canvas>
			<img src="" id="mirror" class="canvas__mirror" />
		</div>
		<button class="button" onclick="downloadPicture()">Download</button>
	</div>


<script src="<?= URL ?>public/js/video.js"></script>-->
<?php /*
    $img = $_POST["img"];
    print_r($img); 
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $dest = base64_decode($img);
    file_put_contents("public/img/tmp.png", $dest);*/
?>
<?php foreach($users as $user): ?>
<h2><?= $user->getUsername() ?></h2>
<h2><?= $user->getEmail() ?></h2>
<h2><?= $user->getId() ?></h2>
<?php endforeach; ?>