<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require('./config/db.php');

    if(isset($_GET['id'])) {
        $product_id = $_GET['id'];

        $result = mysqli_query($db_connect, "SELECT * FROM products WHERE id = $product_id");

        if ($result && $row = mysqli_fetch_assoc($result)) {
    ?>
        <h1>Edit Produk</h1>
        <a type="button" href="show.php">Lihat data produk</a>
        <form action="./backend/edit.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Input nama produk" value="<?=$row['name'];?>">
            <input type="number" name="price" placeholder="Input harga produk" value="<?=$row['price'];?>">
            <p>Gambar Saat Ini: <?=$row['image'];?></p>
            <img src="<?=$row['image'];?>" alt="Gambar Produk" width="100">
            <input type="file" name="new_image">
            <input type="hidden" name="old_image" value="<?=$row['image'];?>">
            <input type="hidden" name="product_id" value="<?=$product_id;?>">
            <input type="submit" value="simpan" name="edit">
        </form>
    <?php
        } else {
            echo "Produk tidak ditemukan.";
        }
    } else {
        echo "ID produk tidak diberikan.";
    }
    ?>
</body>
</html>