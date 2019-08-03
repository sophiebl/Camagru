var likes = document.getElementById('likes_nb');
var heart = document.getElementById('heart');

function likePost(imgId) {
    heart.className =  'icon heart';
    likes.innerText = parseInt(likes.innerText) + 1;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "?url=post&imgId="+ imgId +"&like=ok", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log('DONE');
        }
    };
    xhttp.send();
    //heart.setAttribute('onclick', 'unlikePost()');
}