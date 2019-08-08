<?php
    if (isset($_SESSION['id']) && $_SESSION['id'] !== NULL)
    {
?>
        <a href="<?= URL ?>?url=camera" class="navbar-item" id="pic"></a>
        <a href="<?= URL ?>?url=modification" class="navbar-item" id="settings"></a>
        <a href="<?= URL ?>?url=logout" class="navbar-item" id="logout"></a>
<?php        
    } else {
?>
        <a href="<?= URL ?>?url=login" class="navbar-item" id="login"></a> 
        <a href="<?= URL ?>?url=register" class="navbar-item" id="signin"></a>
<?php
    }
?> 