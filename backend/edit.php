<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require './../config/db.php';

    if(isset($_POST['edit'])) {
        global $db_connect;
    
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $old_image = $_POST['old_image'];
        
        if ($_FILES['new_image']['error'] == 0) {
            $image = $_FILES['new_image']['name'];
            $tempImage = $_FILES['new_image']['tmp_name'];
            $randomFilename = time().'-'.md5(rand()).'-'.$image;
            $uploadPath = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$randomFilename;
    
            $upload = move_uploaded_file($tempImage, $uploadPath);
            if($upload) {
                unlink($_SERVER['DOCUMENT_ROOT'].$old_image);
    
                $updateQuery = "UPDATE products SET name='$name', price='$price', image='/upload/$randomFilename' WHERE id=$product_id";
                $updateResult = mysqli_query($db_connect, $updateQuery);
    
                if ($updateResult) {
                    echo "Berhasil memperbarui data produk.";
                } else {
                    echo "Gagal memperbarui data produk: " . mysqli_error($db_connect);
                }
            } else {
                echo "Gagal mengupload gambar baru.";
            }
        } else {
            $updateQuery = "UPDATE products SET name='$name', price='$price' WHERE id=$product_id";
            $updateResult = mysqli_query($db_connect, $updateQuery);
    
            if ($updateResult) {
                echo "Berhasil memperbarui data produk.";
            } else {
                echo "Gagal memperbarui data produk: " . mysqli_error($db_connect);
            }
        }
       
    }
    ?>
    <p><a type="button" href="./../show.php">Lihat data produk</a></p>
</body>
</html>