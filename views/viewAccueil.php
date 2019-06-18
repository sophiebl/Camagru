<?php
$this->_t = 'Camagru';
foreach($articles as $article): ?>
<h2><?= $article->getTitle() ?></h2>
<time><?= $article->getDate() ?></time>
<?php endforeach; ?>



<?php foreach($users as $user): ?>
<h2><?= $user->getUsername() ?></h2>
<?php endforeach; ?>