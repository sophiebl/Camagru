<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../public/css/my_style.css">
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $t ?></title>
    </head>
    <body>
        <header>
            <nav id="menu">
                <a href="<?= URL ?>?url=accueil" class="navbar-item" id="home"></a>
                <a href="<?= URL ?>?url=gallery" class="navbar-item" id="gallery"></a>
                <?php require_once('modules/header.php'); ?>
            </nav>
        </header>
        <div class="main-content">
            <div class="content">
                <?= $content ?>
            </div>
            <footer>
                <?php
                    require_once('modules/footer.php');
                ?>
            </footer>
        </div>
    <body>
</html>