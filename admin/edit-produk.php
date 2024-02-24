<?php
include_once("../koneksi/koneksi.php");

if (isset($_POST['update'])) {
    $id = $_GET['ProdukID'];
    $name = $_POST['NamaProduk'];
    $harga = $_POST['Harga'];
    $stok = $_POST['stok'];

    $rand = rand();
    $ekstensi =  array('png','jpg','jpeg', 'gif');
    $filename = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($ext,$ekstensi) ) {
        echo "<script>
            alert('Produk gagal Di edit');
        </script>";
    } else{
        if($ukuran < 1044070){		
            $foto = $rand.'_'.$filename;
            move_uploaded_file($_FILES['foto']['tmp_name'], '../image/'.$rand.'_'.$filename);
            $result = mysqli_query($con, "UPDATE produk SET foto='$foto', NamaProduk='$name', Harga=$harga, Stok=$stok WHERE ProdukID=$id");
            echo "<script>
                alert('Produk berhasil Di edit');
                window.location.href='?page=stok';
            </script>";
        } else {
            echo "<script>
                alert('Produk gagal Di edit');
            </script>";
        }
    }

}


$id = $_GET['ProdukID'];

$result1 = mysqli_query($con, "SELECT * FROM produk WHERE ProdukID=$id");

while($user_data = mysqli_fetch_array($result1))
{
	$name = $user_data['NamaProduk'];
	$harga = $user_data['Harga'];
    $stok = $user_data['Stok'];
    $foto = $user_data['foto'];
}
?>
        <div class="col-md-12">
            <div class="card well">
                <div class="card-header">
                    <h3 class="">Update User</h3>
                </div>
                <div class="card-body">
                    <form class="pt-3 mt-3" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Pilih Foto Produk</label>
                            <input type="file" class="form-control-file" value="<?php echo $foto ?>" name="foto" id="">
                        </div>
                        <div class="form-group">
                            <p class="col-form-label" for="">Nama Produk</p>
                            <input type="text" name="NamaProduk" class="form-control" value="<?php echo $name; ?>" id="exampleInputEmail1" placeholder="Nama Barang">
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <p class="col-form-label" for="">Harga</p>
                                <input type="number" name="Harga" class="form-control" value="<?php echo $harga; ?>" id="exampleInputEmail1" placeholder="0">
                            </div>
                            <div class="form-group col-sm-6">
                                <p class="col-form-label" for="">Stok</p>
                                <input type="number" name="stok" class="form-control" value="<?php echo $stok; ?>" id="exampleInputEmail1" placeholder="0">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button class="btn btn-block btn-primary" name="update">Edit Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
