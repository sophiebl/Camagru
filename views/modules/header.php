<?php
    session_start();
    if ($_SESSION['user'])
    {
?>
        <h1><a href="<?= URL ?>">Camagru</a></h1>
        <p>Bienvenue sur Camagru</p>
<?php        
    } else {
?>

        <h1><a href="<?= URL ?>">Camagru</a></h1>
        <p>LOGGUER VOUS</p>
        <a href="<?= URL ?>?url=login">LOGIN</a>

<?php
    }
?> 
    
    