<?php
$hostname = "127.0.0.1"; // this is the hostname that you can find in the PhpMyAdmin and you can write "localhost" too
$username = "root"; // be default the userName for the databases is root
$password = ""; // by default there is not password in the databases
$dbname = "cr11_petadoption_MichaelR" ; // here we need to write the Database name
            
// create connection, you need to be aware of the order of the parameters
$connect = new mysqli($hostname, $username, $password, $dbname);
            
// check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
    }/* else {
    echo "Connected successfully";
    } */
?>