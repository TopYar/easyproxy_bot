<?php
$token = "xxxx";


// Данные базы данных
   $host ='localhost';
   $user = 'xxxx';
   $password = 'xxx';
   $database = 'xxx'; 


$link = new mysqli("$host", "$user", "$password", "$database");
if ($link->connect_error) {
    die('Error : ('. $link->connect_errno .') '. $link->connect_error);
}
