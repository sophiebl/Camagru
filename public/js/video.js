/*

var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var canvasFilter = document.getElementById('canvasFilter');
var contextFilter = canvasFilter.getContext('2d');
var video = document.getElementById('video');
var snap = document.getElementById('snap');
var clear = document.getElementById('clear');
var upload = document.getElementById('upload');
var retry = document.getElementById('retry');
var upload = document.querySelector('input[type="file"]');
var btns = document.getElementsByClassName('btn-container');

var img = null;
var data = null;
var filter = null;
var draw = false;
var uploaded = false;
var pic_info;

var currX = canvas.width/2;
var currY = canvas.height/2;
var isDraggable = false;

var coordX = null;
var coordY = null;
var final = null;

if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	navigator.mediaDevices.getUserMedia({ video: true})
	.then(function(mediaStream) {
		video.srcObject = mediaStream;
		video.play();
	})
    .catch(function(err) {
		console.log("Error stream: " + err);
    });
}

function snapPic() {
	if (!uploaded)
	{
		context.drawImage(video, 0, 0, canvas.width, canvas.height);
		data = canvas.toDataURL('image/png');
	} else {
		contextFilter.drawImage(video, 0, 0, canvs.width, canvas.height);
		data = canvas.toDataURL('image/png');
	} 
	if (filter) {
		draw = new Image();
	}
}
*/




























































// import file
/*
window.onload = () => {

	var formRegister = document.getElementById('formRegister');
	var input_file = document.querySelector('#import_file');
	var	publish = document.getElementById('publi');
	var name = document.querySelector('#file_name');
	var image = document.getElementById('image');
	//var name2 = document.querySelector('#file_name2');
	var trash = document.getElementById('trash');
	input_file.addEventListener('change', handleFiles);
	trash.addEventListener('click', delete_files);

function handleFiles(e) {
	file = e.target.files[0];
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	var blank = document.getElementById('blank');
	if (canvas.toDataURL() !== blank.toDataURL())
	ctx.clearRect(0, 0, canvas.width, canvas.height);
    var img = new Image;
    img.src = URL.createObjectURL(file);
    img.onload = function() {
		filter.style.display = '';
		name.innerText = file.name;
		image.innerText = file.name;
		publish.disabled = false;
		ctx.drawImage(img, 0, 0, 600, 400);
	}
}

function prepareImg() {
	var canvas = document.getElementById('canvas');
	var blank = document.getElementById('blank');

	if (canvas.toDataURL() !== blank.toDataURL())
		{
			document.getElementById('inp_img').value = canvas.toDataURL();
		}
	}
	
	function delete_files(e)
	{
		var filter = document.getElementById('canvasFilter');
		//var filter = document.getElementById('filter');
		var canvas = document.getElementById('canvas');
		var ctx = canvas.getContext('2d');
		// var blank = document.getElementById('blank');
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		//name.innerText = "Aucune image importée";
		//document.getElementById('image').value = "Aucune image";
		publish.disabled = true;
		filter.style.display = 'none';
	}
}
*/
function addFilter(event)
{
	var canvas = document.getElementById('canvasFilter');
	var ctx = canvas.getContext('2d');
	var img = new Image(32, 32);
	img.src = event.target.src;
	img.onload = function() {
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctx.drawImage(img, 75, 75, 32, 32);
	}
	document.getElementById('snap').disabled = false;
}

// take picture
(function() {
    var streaming = false,
    //Prepare elements and make settings
    video        = document.getElementById('video'),
    //cover        = document.querySelector('#cover'),
    canvas       = document.getElementById('canvas'),
    startbutton  = document.getElementById('snap'),
	savebutton  = document.getElementById('save'),
	data = null,
    width = 200,
    height = 200;

    //Elements by taking a picture
	var name = document.getElementById('file_name');
	var image = document.getElementById('image');
	//var name2 = document.getElementById('file_name2');
	var blank = document.getElementById('blank');
	var result = document.getElementById('result');
	var	publish = document.getElementById('publish');
	var context = canvas.getContext('2d');
	var constraints = { audio: false, video: { width: 200, height: 200 } }; 

    //Get access to the camera
	navigator.mediaDevices.getUserMedia(constraints)
	.then(function(mediaStream) {
//		startbutton.disabled = false;
	    var video = document.querySelector('video');
	    video.srcObject = mediaStream;
	    video.onloadedmetadata = function(e) {
	    	video.play();
	    };
    })
    .catch(function(err) {
		//startbutton.disabled = true;
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
		{
			result.src = canvas.toDataURL();
		    context.clearRect(0, 0, canvas.width, canvas.height);
		   // name.innerText = "Aucune image importée";
		    //image.innerText = "Aucune image";
		}
		//var currentDate = new Date();
		canvas.width = width;
		canvas.height = height;
		//document.getElementById('image').value = currentDate.getTime() + ".png";
		publish.disabled = false;
		//filter.style.display = '';
		context.drawImage(video, 0, 0, width, height);
	}

//	function prependNewImg()



/*
	function savepicture() {
		if (data)
		{
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "?url=camera&submit=OK", true);
			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText);
						prependNewImg(this.responseText);
						if (uploadPic)
							clearCanvasTop();
						clearCanvas();
				}
			}; 
			xhttp.send("picture=" + data + "&filter=" + filter + "&x=");
		}
	}
	*/
	startbutton.addEventListener('click', function(ev){
		takepicture();
		ev.preventDefault();
	}, false);
/*
	savebutton.addEventListener('click', function(ev){
		data = result.src;
		savepicture();
		ev.preventDefault();
	}, false);*/
})();



