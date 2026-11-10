<?php

include '../connect/koneksi.php';

//untuk query menyesuaikan entah mau memasukan atau update , atau sekedar melihat atau bahkan edit
$query = "SELECT * FROM categories ORDER BY CategoryID ASC";

//untuk connect disini harus urut mulai dari $koneksi setelah itu query
$result = mysqli_query($koneksi,$query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori Produk</title>
</head>
<body>
    <h2>Daftar Kategori (Categories)</h2> 
    <table border="1"> 
        <thead> 
            <tr> 
                <th>ID</th> 
                <th>Nama Kategori</th>
                 <th>Deskripsi</th> 
            </tr> 
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?> 
                <tr> 
                    <td><?= $row['CategoryID'] ?></td> 
                    <td><a href="produk.php?CategoryID=<?= $row['CategoryID'] ?>"><?= $row['CategoryName'] ?></a></td> 
                    <td><?= $row['Description'] ?></td> 
                </tr> 
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>