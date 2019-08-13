// Filter

function addFilter(event)
{
	var canvas = document.getElementById('canvasFilter');
	var ctx = canvas.getContext('2d');
	var img = new Image(300, 300);
	img.src = event.target.src;
    var width = 300;
    var height = 300;
	canvas.setAttribute('width', width);
	canvas.setAttribute('height', height);
	canvas.width = width;
	canvas.height = height;
	img.onload = function() {
		ctx.clearRect(0, 0, 300, canvas.height);
		ctx.drawImage(img, 0, 0, 300, 300, 0, 0, 300, 300);
		document.querySelector('#imgFilter').setAttribute('src', canvas.toDataURL("image/png"));
		document.querySelector('#resultFilter').setAttribute('value', canvas.toDataURL("image/png"));
	}
	document.getElementById('snap').disabled = false;
}

// take picture
(function() {
    var streaming = false,
    //Prepare elements and make settings
    video        = document.getElementById('video'),
    canvas       = document.getElementById('canvas'),
    canvasFilter  = document.getElementById('canvasFilter'),
    startbutton  = document.getElementById('snap'),
	savebutton  = document.getElementById('save'),
    width = 300,
    height = 300;

    //Elements by taking a picture
	var name = document.getElementById('file_name');
	var image = document.getElementById('image');
	var blank = document.getElementById('blank');
	var result = document.getElementById('result');
	var result2 = document.getElementById('result2');
	var resultFilter = document.getElementById('resultFilter');
	var	publish = document.getElementById('publish');
	var context = canvas.getContext('2d');
	var contextFilter = canvasFilter.getContext('2d');
	var constraints = { audio: false, video: { width: 300, height: 300 } }; 
	var formRegister = document.getElementById('formPicture');
	var input_file = document.querySelector('#import_file');
	var name2 = document.querySelector('#file_name2');
	var retry = document.getElementById('retry');

    //Get access to the camera
	navigator.mediaDevices.getUserMedia(constraints)
	.then(function(mediaStream) {
	    var video = document.querySelector('video');
	    video.srcObject = mediaStream;
	    video.onloadedmetadata = function(e) {
	    	video.play();
	    };
    })
    .catch(function(err) {
		console.log("Error stream: " + err);
    });
    
	video.addEventListener('canplay', function(ev){
	if (!streaming) {
		height = video.videoHeight / (video.videoWidth/width);
		video.setAttribute('width', width);
		video.setAttribute('height', height);
		canvas.setAttribute('width', width);
		canvas.setAttribute('height', height);
		streaming = true;
	}
	}, false);

	function takepicture() {
		var base64 = canvas.toDataURL();
		console.log(base64);
		if (canvas.toDataURL() !== blank.toDataURL())
		    context.clearRect(0, 0, canvas.width, canvas.height);
		canvas.width = width;
		canvas.height = height;
		publish.disabled = false;
		context.drawImage(video, 0, 0, width, height);
	}

	input_file.addEventListener('change', importFile);
	function importFile(e) {
		file = e.target.files[0];
		var canvas = document.getElementById('canvas');
		var ctx = canvas.getContext('2d');
		var blank = document.getElementById('blank');
		if (canvas.toDataURL() !== blank.toDataURL())
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		var img = new Image;
		img.src = URL.createObjectURL(file);
		img.onload = function() {
			name2.innerText = file.name;
			ctx.drawImage(img, 0, 0, 300, 300);
		}
	}

	function savePicture() {
		document.querySelector('#result').setAttribute('value', canvas.toDataURL("image/png"));
	}

	function retryPic()
	{
		var canvasFilter = document.getElementById('canvasFilter');
		var canvas = document.getElementById('canvas');
		var ctx = canvas.getContext('2d');
		var ctxFilter = canvasFilter.getContext('2d');
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctxFilter.clearRect(0, 0, canvasFilter.width, canvasFilter.height);
		document.getElementById('snap').disabled = true;
		name2.innerText = "Aucune image";
	}

	retry.addEventListener('click', function(ev){
		retryPic();
		ev.preventDefault();
	}, false);

	startbutton.addEventListener('click', function(ev){
		takepicture();
		ev.preventDefault();
	}, false);

	savebutton.addEventListener('click', function(ev){
		savePicture();
		ev.preventDefault();
	}, false);
})();

