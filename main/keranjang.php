<?php
session_start();
include '../connect/koneksi.php';

//cek apakah url di buka dengan method POST atau GET, dan checking apakah var product ini sudah ada atau belum
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ProductID'],$_POST['jumlah'])){
    $product_id = $_POST['ProductID']; //ambil id product
    $jumlah = (int)$_POST['jumlah']; // ambil jumlah yg mau di beli dari product 

    if(isset($_SESSION['cart'][$product_id])){
        $_SESSION['cart'][$product_id] += $jumlah;//product ada ? tambah jumlah belinya
    } else {
        $_SESSION['cart'][$product_id] = $jumlah;//product belum ada ? buat baru
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
                $grand_total = 0; //inisiasi  jumlah harga total
                if(!empty($_SESSION['cart'])): // checking keranjang apakah kosong atau tidak
                    foreach($_SESSION['cart'] as $p_id => $qty): //kalau tidak, maka ambil idproduct dan hitung jumlah yg mau di beli
                        $query = "SELECT * FROM products where ProductID = '$p_id'"; // query untuk ambil data product
                        $result = mysqli_query($koneksi,$query); // proses ambil
                        $row = mysqli_fetch_assoc($result); // proses tampilkan
                        $subtotal = $row['UnitPrice']*$qty; // hitung total dengan cara harga per unit * banyak yg mau dibeli
                        $grand_total += $subtotal; // tambahkan ke jumlah harga agar dihitung sebagai total harga
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
        <?php if(!empty($_SESSION['cart'])): //checking apakah keranjang kosong ? ?> 
        <tfoot>
            <tr>
                <th colspan="4" align="right">total bayar : </th>
                <th> <?= $grand_total // kalau keranjang tidak kosong, maka tampilkan jumlah total barang yg di beli?></th>
            </tr>
        </tfoot>
        <?php endif ?>
    </table>
    <?php if(!empty($_SESSION['cart'])): //checking apakah keranjang kosong ??>
        <br>
        <form action="bayar.php" method="post">
            <button type="submit">Cek Out</button>
        </form>
        <?php endif // kalau tidak tampilkan apakah mau checkout apa tidak ?>
</body>
</html>