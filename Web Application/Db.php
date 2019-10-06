<?php

$serverhost = 'localhost';
$dBuser = 'root';
$dBpass = '';
$db = 'accounts';

$conn = mysqli_connect($serverhost, $dBuser, $dBpass, $db);

if(!$conn){
    die("Connection failed: ".  mysqli_connect_error());
}
