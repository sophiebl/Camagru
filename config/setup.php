#!/usr/bin/php
<?php
    require_once('database.php');
    try {
        $dbh = new PDO("mysql:host=127.0.0.1;port:3306", $DB_USER, $DB_PASSWORD);
        $dbh->exec("CREATE DATABASE $DB_BASE")
        or die(print_r($dbh->errorInfo(), true));

    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
	try {
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$create = file_get_contents('insert.sql');
        $db->exec($create);
        echo "Table crée avec succées \n";
    } catch (PDOException $e) {
        echo "DB ERROR:\n";
        echo $e->getMessage();
        $db->closeCursor();
        die();
    }
?>