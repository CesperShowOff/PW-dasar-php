<?php
include "../connect/koneksi.php";
//ambil id product
$produk_id = $_GET['ProductID'];
//query untuk ambils seluruh data dalam product lewat id product
$query = "SELECT * FROM products where ProductID = '$produk_id'";
//proses ambil
$result = mysqli_query($koneksi,$query);
//proses tampil
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Product</title>
</head>
<body>
    <h2>Detail Products <?= $row['ProductName'] ?></h2>
    <p><a href="product.php?CategoryID=<?= $row['CategoryID']?>">kembali ke Daftar Product</a></p>
    <table border="1">
        <tr><th>Product ID</th><td><?= $row['ProductID'] ?></td></tr>
        <tr><th>Nama Product</th><td><?= $row['ProductName']?></td></tr>
        <tr><th>Supplier</th><td><?= $row['SupplierID']?></td></tr>
        <tr><th>Jumlah per unit</th><td><?= $row['QuantityPerUnit']?></td></tr>
        <tr><th>Harga per unit</th><td><?=$row['UnitPrice']?></td></tr>
        <tr><th>Stock dalam Gudang</th><td><?=$row['UnitsInStock']?></td></tr>
        <tr><th>Jumlah Pesanan</th><td><?=$row['UnitsOnOrder']?></td></tr>
        <tr><th>Batas Pemesanan Ulang</th><td><?=$row['ReorderLevel']?></td></tr>
        <tr><th>Status Discontinued</th><td><?=$row['Discontinued']?></td></tr>
    </table>

    <h3>Form Pembelian</h3>
    <form action="keranjang.php" method="POST">
        <input type="hidden" name="ProductID" value="<?=$row['ProductID']?>">
        <label for="jumlah">jumlah beli:</label>
        <input type="number" name="jumlah" id="jumlah" min="1" max="<?=$row['UnitsInStock']?>" value="1" required>
        <button type="submit">tambah ke keranjang</button>
    </form>
</body>
</html>