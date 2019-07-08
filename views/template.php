<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $t ?></title>
    </head>
    <header>
        <?php
            require_once('modules/header.php');
        ?>

    </header>
    <?= $content ?>
    <footer>
        <?php
            require_once('modules/footer.php');
        ?>
    </footer>
</html>