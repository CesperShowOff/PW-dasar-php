<?php
session_start();
include "../connect/koneksi.php";

if(empty($_SESSION['cart'])){
    header("location:kategori.php");
    exit;
}

$resQuery = "SELECT MAX(OrderID) as maxID FROM Orders";
$resmax = mysqli_query($koneksi,$resQuery);
$rowmax = mysqli_fetch_assoc($resmax);
$order_id = $rowmax['maxID'] +1;

$orderDate = date("Y-m-d H:i:s");
$queryOrder = "INSERT INTO orders (OrderID,OrderDate) Values ('$order_id','$orderDate')";
mysqli_query($koneksi,$queryOrder);

foreach($_SESSION['cart'] as $p_id => $qty){
    $queryProduct = "SELECT UnitPrice FROM products where ProductID = $p_id";
    $resProduct = mysqli_query($koneksi,$queryProduct);
    $rowProduct = mysqli_fetch_assoc($resProduct);
    $unitPrice = $rowProduct['UnitPrice'];

    $queryDetail = "INSERT INTO orderdetails (OrderID, ProductID, UnitPrice, Quantity, Discount) VALUES ('$order_id','$p_id','$unitPrice','$qty',0)";
    mysqli_query($koneksi,$queryDetail);
}

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