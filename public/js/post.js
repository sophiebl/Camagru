var likes = document.getElementById('likes_nb');
var heart = document.getElementById('heart');

function likePost() {
   heart.className =  'icon heart';
   likes.innerText = parseInt(likes.innerText) + 1;
   var xhttp = new XMLHttpRequest();
   xhttp.open("GET", "?url=post&like=ok", true);
   xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
   xhttp.send();
   heart.setAttribute('onclick', 'unlikePost()');
}