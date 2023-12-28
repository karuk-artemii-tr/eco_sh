<?php
$host     = "localhost";
$port     = 3306;
$socket   = "";
$user     = "root";
$password = "adfly321";
$dbname   = "eko_sh";
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
    or die ('Could not connect to the database server' . mysqli_connect_error());

// $servername = "sql7.freemysqlhosting.net";
// $username = "sql7597720";
// $password = "qNwZDMgpSh";
// $dbname = "sql7597720";

// $servername = "localhost:3306";
// $username = "root";
// $password = "root";
// $dbname = "ekomenegment";



// $con = mysqli_connect($servername, $username, $password, $dbname);
// if ($con->connect_error) {
    // die("Connection failed: " . $con->connect_error);
  // }
// $con -> set_charset("utf8");

?>