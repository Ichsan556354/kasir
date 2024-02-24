<?php

include_once("../koneksi/koneksi.php");
$id = $_GET['ProdukID'];
$result = mysqli_query($con, "DELETE FROM produk WHERE ProdukID=$id");
echo "<script>
            alert('Produk berhasil Dihapus');
            window.location.href='?page=stok';
        </script>";
?>