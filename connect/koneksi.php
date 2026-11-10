<?php

$host  = "localhost";
$username  = "root";
$password  = "";
$database  = "pertemuan6pemweb";
$port  = "3306";

$koneksi = mysqli_connect($host,$username,$password,$database,$port);

if(!$koneksi){
    die("koneksi gagal : " . mysqli_connect_error());    
}

?>