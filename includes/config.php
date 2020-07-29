<?php 
$user = "root";
$pass = "";
$dbName = "mjs_cms";

@$dbConnection = mysqli_connect($host,$user,$pass,$dbName);
mysqli_set_charset($dbConnection,'utf8');

if (!$dbConnection){
    echo "Sorry I can't connect to the Database!";
}