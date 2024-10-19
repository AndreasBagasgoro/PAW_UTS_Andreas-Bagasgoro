<?php 

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "dreas_company";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error){
    echo "koneksi database eror";
    die("error!");
}

mysqli_select_db($db, $database_name);



?>