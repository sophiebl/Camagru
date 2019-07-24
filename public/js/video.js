// import file

window.onload = () => {

	var formRegister = document.getElementById('formRegister');
	var input_file = document.querySelector('#import_file');
	var	publish = document.getElementById('publi');
	var name = document.querySelector('#file_name');
	var name2 = document.querySelector('#file_name2');
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
		name2.innerText = file.name;
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
	var filter = document.getElementById('filter');
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	// var blank = document.getElementById('blank');
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	name.innerText = "Aucune image importée";
	name2.innerText = "Aucune image";
	publish.disabled = true;
	filter.style.display = 'none';
}
}

function addFilter(event)
{
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	var img = new Image(32, 32);
	img.src = event.target.src;
	img.onload = function() {
		ctx.drawImage(img, 75, 75, 32, 32);
	}
}

// take picture
(function() {
    var streaming = false,
    //Prepare elements and make settings
    video        = document.getElementById('video'),
    //cover        = document.querySelector('#cover'),
    canvas       = document.getElementById('canvas'),
    startbutton  = document.getElementById('snap'),
    width = 200,
    height = 200;

    //Elements by taking a picture
	var name = document.getElementById('file_name');
	var name2 = document.getElementById('file_name2');
	var blank = document.getElementById('blank');
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
		if (canvas.toDataURL() !== blank.toDataURL())
		{
		    context.clearRect(0, 0, canvas.width, canvas.height);
		    name.innerText = "Aucune image importée";
		    name2.innerText = "Aucune image";
		}
		var currentDate = new Date();
		canvas.width = width;
		canvas.height = height;
		name2.innerText =  currentDate.getTime() + ".png";
		publish.disabled = false;
		//filter.style.display = '';
		context.drawImage(video, 0, 0, width, height);
	}

	startbutton.addEventListener('click', function(ev){
		console.log('ta mere');
		//break;
		takepicture();
	ev.preventDefault();
	}, false);

})();



