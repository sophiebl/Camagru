var likes = document.getElementById('likes_nb');
var heart = document.getElementById('heart');

function likePost() {
    likes.innerText = parseInt(likes.innerText) + 1;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", location.search + "&like=ok", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        }
    };
    xhttp.send();
    heart.setAttribute('onclick', 'unlikePost()');
    heart.src = "../img/heart_pink.png";
}

function unlikePost() {
    likes.innerText = parseInt(likes.innerText) - 1;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", location.search + "&like=ok", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        }
    };
    xhttp.send();
    heart.src = "../img/heart_small.png";
    heart.setAttribute('onclick', 'likePost()');
}

function prependNewComment(author, content, id) {
    var status;
    var  post = document.getElementsByClassName('comment-container')[0]
    if(document.getElementsByClassName('comment-item')[0] == null) {
        var commentItem = document.createElement('div');
        commentItem.className = 'comment-item';
        post.appendChild(commentItem);
        status = 1;
    }
    else {
        var commentItem = document.getElementsByClassName('comment-item')[0];
        status = 0;
    }
    var mainDiv = document.createElement('div');
    var commContent = document.createElement("p");
    var secondDiv = document.createElement('div');
    var from = document.createElement("p");
    commContent.id = 'content';
    commContent.innerText = content;
    mainDiv.appendChild(commContent);
    mainDiv.appendChild(secondDiv);
    secondDiv.appendChild(from);
    secondDiv.id = 'author';
    var url = new URL(location.href);
    url.searchParams.set('commid', id);
    from.innerHTML += 'by <span id="bottom">' + author + '</span>';
    from.innerHTML += '<a href="' + url + '"></a>';
    if (status) {
        commentItem.appendChild(mainDiv);
    }
    else {
        commentItem.insertBefore(mainDiv, commentItem.firstChild);
    }
}

function leaveComment(author) {
    var content = document.getElementById("commentContent").value;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", location.search + "&comment=ok&content=" + content, true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            prependNewComment(author, content, this.responseText);
        }
    };
    xhttp.send();
}