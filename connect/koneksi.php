<?php


//variable yg dibutuhkan
$host  = "localhost";
$username  = "root";
$password  = "";
$database  = "pertemuan6pemweb";
$port  = "3306";

//gunakan "mysqli_connect" untuk membuat hubungan antara variable yg sudah dibangun
$koneksi = mysqli_connect($host,$username,$password,$database,$port);

//jika koneksi gagal saja (optional)
if(!$koneksi){
    die("koneksi gagal : " . mysqli_connect_error());    
}

?>