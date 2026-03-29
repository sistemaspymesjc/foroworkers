<?php

// include_once('myconfig.php');

require __DIR__.'/../myconfig.php';


    $dbHost     = CDB_DATABASE_HOST;
    $dbUsername = CDB_DATABASE_USERNAME;
    $dbPassword = CDB_DATABASE_PASSWORD;
    $dbName     = CDB_DATABASE;
   

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
     die("Connection failed:");
    // die("Connection failed: " . $db->connect_error);
}

?>