<?php
include "DBConnect.php";

$connection=new DBConnect();
//$connection->registration("Test","Test","Test@gmail.com","Test0000","image1.jpg");
$connection->login("Test@gmail.com","Test0000");



?>