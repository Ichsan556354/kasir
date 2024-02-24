<?php
include_once("../koneksi/koneksi.php");
$id = $_GET['UserID'];
$result = mysqli_query($con, "DELETE FROM user WHERE UserID=$id");
echo 
    "<script>
        alert('berhasil dihapus');
        windows.location('index.php?page=user');
    </script>";
?>
