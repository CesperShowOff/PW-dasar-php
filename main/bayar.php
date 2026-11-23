<?php
session_start();
include "../connect/koneksi.php";

if(empty($_SESSION['cart'])){
    header("location:kategori.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
</head>
<body>
    <h2>konfirmasi Pembayaran</h2>
    <p><a href="keranjang.php">kembali ke keranjang</a></p>
    <table border="1">
        <thead>
            <tr>
                <th>ID product</th>
                <th>nama product</th>
                <th>harga satuan</th>
                <th>jumlah beli</th>
                <th>subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grand_total = 0;
            foreach($_SESSION['cart'] as $p_id => $qty):
                $query = "SELECT * FROM products where ProductID = '$p_id'";
                $result = mysqli_query($koneksi,$query);
                $row = mysqli_fetch_assoc($result);
                $subtotal = $row['UnitPrice']*$qty;
                $grand_total+=$subtotal;
            ?>
            <tr>
                <td><?= $row['ProductID']?></td>
                <td><?= $row['ProductName']?></td>
                <td><?= $row['UnitPrice']?></td>
                <td><?= $qty ?></td>
                <td><?= $subtotal ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" align="right">total yg perlu dibayar</th>
                <th><?= $grand_total ?></th>
            </tr>
        </tfoot>
    </table>
    <br>
    <form action="proses_bayar.php" method="post">
        <button type="submit">bayar</button>
    </form>
</body>
</html>