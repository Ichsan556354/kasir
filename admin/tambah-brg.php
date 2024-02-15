<div class="card">
    <div class="card-body">
        <h3 class="">Tambah Produk</h3>
                    
                    
        <form class="pt-3 mt-3"  method="post" enctype="multipart/form-data">
            <div class="form-group">
                <p class="col-form-label" for="">ID Produk</p>
                <input type="text" name="idproduk" class="form-control form-control" id="exampleInputEmail1" placeholder="123xxx">
            </div>
            <div class="form-group">
                <label for="">Pilih Foto</label>
                <input type="file" name="foto" class="form-control-file form-control" id="contohupload1">                            
                <p class="card-description"><code>Format gambar .jpg .png</code></p>
            </div>
            <div class="form-group">
                <p class="col-form-label" for="">Nama Produk</p>
                <input type="text" name="NamaProduk" class="form-control form-control" id="exampleInputEmail1" placeholder="Nama Barang">
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <p class="col-form-label" for="">Harga</p>
                    <input type="number" name="Harga" class="form-control form-control" id="exampleInputEmail1" placeholder="0">
                </div>
                <div class="form-group col-sm-6">
                    <p class="col-form-label" for="">Stok</p>
                    <input type="number" name="stok" class="form-control form-control" id="exampleInputEmail1" placeholder="0">
                </div>
            </div>
            
            <div class="form-group">
                <button class="btn btn-block btn-primary" name="submit">Tambah Produk</button>
            </div>
        </form>
    </div>
</div>
<?php 

include '../koneksi/koneksi.php';

if (isset($_POST['submit'])){
$id = $_POST['idproduk'];
$name = $_POST['NamaProduk'];
$harga = $_POST['Harga'];
$stok = $_POST['stok'];


$rand = rand();
$ekstensi =  array('png','jpg','jpeg', 'gif');
$filename = $_FILES['foto']['name'];
$ukuran = $_FILES['foto']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);


if(!in_array($ext,$ekstensi) ) {
    header("location:index.php?page=tambah-produk");
} else{
    if($ukuran < 1044070){		
        $foto = $rand.'_'.$filename;
        move_uploaded_file($_FILES['foto']['tmp_name'], '../image/'.$rand.'_'.$filename);
        mysqli_query($con, "INSERT INTO produk (ProdukID, foto, NamaProduk, Harga, Stok) VALUES('$id', '$foto', '$name', '$harga', '$stok')");
        header("location:index.php?alert('berhasil')");
    }else{
        header("location:index.php?alert=gagak_ukuran");
        echo "Salah ga tau kenapa";
    }
    
    // Show message when user added
    echo "<script>alert('Product added successfully.')</script>";
} 
}
?>