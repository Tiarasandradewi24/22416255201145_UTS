<?php
require './config/db.php';

if(isset($_GET['id'])) {
    $productId = $_GET['id'];
    $deleteQuery = "DELETE FROM products WHERE id = $productId";
    $result = mysqli_query($db_connect, $deleteQuery);

    if($result) {
        header("Location: show.php");
        exit();
    } else {
        echo "Gagal menghapus produk.";
    }
} else {
    echo "ID produk tidak valid.";
}
?>