<?php
    //session_start();
    if (!isset($_SESSION['id']) && $_SESSION['id'] == NULL)
    {
?>
        <a href="<?= URL ?>?url=login" class="navbar-item">Login</a> 
        <a href="<?= URL ?>?url=register" class="navbar-item">Sign in</a>
<?php        
    } else {
?>
        <a href="<?= URL ?>?url=camera" class="navbar-item">Take your pic!</a>
        <a href="<?= URL ?>?url=modification" class="navbar-item">Settings</a>
        <a href="<?= URL ?>?url=logout" class="navbar-item">Logout</a>
<?php
    }
?> 