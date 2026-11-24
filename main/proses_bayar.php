<?php
session_start();
include "../connect/koneksi.php";

//check keranjang apakah kosong atau tidak
if(empty($_SESSION['cart'])){
    header("location:kategori.php");
    exit;
}

//ambil max id dari order
$resQuery = "SELECT MAX(OrderID) as maxID FROM Orders";
//proses ambil
$resmax = mysqli_query($koneksi,$resQuery);
//proses tampil 
$rowmax = mysqli_fetch_assoc($resmax);
//buat order id menjadi increment dengan menambah +1 setiap kali order dibuat
$order_id = $rowmax['maxID'] +1;

//set data tanggal order
$orderDate = date("Y-m-d H:i:s");
//query untuk memasukan data tanggal order ke table orders
$queryOrder = "INSERT INTO orders (OrderID,OrderDate) Values ('$order_id','$orderDate')";
//proses memasukan
mysqli_query($koneksi,$queryOrder);

//ambil id product dan hitung jumlah yg mau dibeli dari product dengan id tersebut
foreach($_SESSION['cart'] as $p_id => $qty){
    $queryProduct = "SELECT UnitPrice FROM products where ProductID = $p_id";//ambil harga per unit dengan id product 
    $resProduct = mysqli_query($koneksi,$queryProduct); // proses ambil
    $rowProduct = mysqli_fetch_assoc($resProduct); // proses tampil
    $unitPrice = $rowProduct['UnitPrice']; //ambil harga perunit

    //query untuk memasukan orderdetails
    $queryDetail = "INSERT INTO orderdetails (OrderID, ProductID, UnitPrice, Quantity, Discount) VALUES ('$order_id','$p_id','$unitPrice','$qty',0)";
    mysqli_query($koneksi,$queryDetail); // proses untuk masukan
}

//kosongkan keranjang lagi setelah memasukan data product yg dibeli ke data orderdetails
unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Berhasil</title>
</head>
<body>
    <h2>pembayar berhasil</h2>
    <p>terimakasih karena sudah berbelanja disini</p>
    <p><a href="kategori.php">ketuk untuk kembali ke halaman kategori</a></p>
</body>
</html>