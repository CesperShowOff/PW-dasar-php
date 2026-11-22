<?php
session_start();
include '../connect/koneksi.php';


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ProductID'],$_POST['jumlah'])){
    $product_id = $_POST['ProductID'];
    $jumlah = (int)$_POST['jumlah'];

    if(isset($_SESSION['cart'][$product_id])){
        $_SESSION['cart'][$product_id] += $jumlah;
    } else {
        $_SESSION['cart'][$product_id] = $jumlah;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
</head>
<body>
    <h2>kantong keranjang</h2>
    <p><a href="kategori.php">Kembali ke daftar kategori</a></p>
    
    <table border="1">
        <thead>
            <tr>
                <th>produk</th>
                <th>nama product</th>
                <th>harga satuan</th>
                <th>jumlah beli</th>
                <th>subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $grand_total = 0;
                if(!empty($_SESSION['cart'])):
                    foreach($_SESSION['cart'] as $p_id => $qty):
                        $query = "SELECT * FROM products where ProductID = '$p_id'";
                        $result = mysqli_query($koneksi,$query);
                        $row = mysqli_fetch_assoc($result);
                        $subtotal = $row['UnitPrice']*$qty;
                        $grand_total += $subtotal;
            ?>
            <tr>
                <td><?= $row['ProductID']?></td>
                <td><?= $row['ProductName']?></td>
                <td><?= $row['UnitPrice']?></td>
                <td><?= $qty?></td>
                <td><?= $subtotal?></td>
            </tr>
            <?php 
                endforeach;
                else :
            ?>
            <tr>
                <td colspan="5"> keranjang masih kosong </td>
            </tr>
            <?php endif ?>
        </tbody>
        <?php if(!empty($_SESSION['cart'])):?>
        <tfoot>
            <tr>
                <th colspan="4" align="right">total bayar : </th>
                <th> <?= $grand_total ?></th>
            </tr>
        </tfoot>
        <?php endif ?>
    </table>
    <?php if(!empty($_SESSION['cart'])):?>
        <br>
        <form action="bayar.php" method="post">
            <button type="submit">Cek Out</button>
        </form>
        <?php endif ?>
</body>
</html>