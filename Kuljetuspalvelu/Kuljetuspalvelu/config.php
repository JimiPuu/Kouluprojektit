<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'mysql.cc.puv.fi');
define('DB_USERNAME', 'e1900910');
define('DB_PASSWORD', 'TkRePgD4pyzq');
define('DB_NAME', 'e1900910_KuljetusPalvelu');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>