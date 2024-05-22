<?php
//Database credentials
$dbHost = 'localhost';
$dbUsername = 'jobportal';
$dbPassword = 'jobportal';
$dbName = 'jobportal';

//Connect with the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//Display error if failed to connect
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}
?>
