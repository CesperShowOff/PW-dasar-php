<?php
include '../connect/koneksi.php';

$category_id = $_GET['CategoryID'];
$query = "SELECT ProductID, ProductName, QuantityPerUnit, UnitPrice, UnitsInStock from products WHERE CategoryID = '$category_id' order by ProductID ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Product</title>
</head>
<body>
    <h2>Daftar Product (Category ID : <?=$category_id?>)</h2>
    <p><a href="kategori.php">kembali ke Halaman kategori</a></p>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Product</th>
                <th>Jumlah Per Unit</th>
                <th>Harga Satuan</th>
                <th>stock</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['ProductID'] ?></td>
                    <td><?= $row['ProductName'] ?></td>
                    <td><?= $row['QuantityPerUnit']?></td>
                    <td><?= $row['UnitPrice']?></td>
                    <td><?= $row['UnitsInStock']?></td>
                </tr>
                <?php endwhile;?>
        </tbody>
    </table>
</body>
</html>