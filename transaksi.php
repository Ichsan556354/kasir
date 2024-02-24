<?php
    include "koneksi/koneksi.php";
    
    //kode penjualan
    $query1 = mysqli_query($con, "SELECT max(PenjualanID) as kodeTerbesar FROM penjualan");
    $data1 = mysqli_fetch_array($query1);
    $kodePenjualan = $data1['kodeTerbesar'];
    
    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kodePenjualan, 3, 3);
    
    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;
    
    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = "421";
    $PenjualanID = $huruf . sprintf("%03s", $urutan);
?>

<?php 
    // ID PELANGGAN
    $queryIdPelanggan = mysqli_query($con, "SELECT max(PelangganID) as kodeTerbesar FROM pelanggan");
    $dataPelangganID = mysqli_fetch_array($queryIdPelanggan);
    $kodePelanggan = $dataPelangganID['kodeTerbesar'];
    $urutanPelanggan = (int) substr($kodePelanggan, 3, 3);
    
    $urutanPelanggan++;
    $huruf2 = "222";
    $PelangganID = $huruf2 . sprintf("%03s", $urutanPelanggan);
echo $PelangganID;
    // ID DETAIL PENJUALAN
    $query = mysqli_query($con, "SELECT max(DetailID) as kodeTerbesar FROM detailpenjualan");
    $data = mysqli_fetch_array($query);
    $kodeDetail = $data['kodeTerbesar'];
    $urutan = (int) substr($kodeDetail, 3, 3);

    $urutan++;
    $huruf = "111";
    $DetailID = $huruf . sprintf("%03s", $urutan);

    $totalHarga = 0;
    if (isset($_POST['pesan'])) {
        $idPenjualan = $_POST['noTransaksi'];

        // simpan data transaksi (detail)
        $namaProduk = $_POST['namaProduk'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $totalHarga = $harga * $jumlah;
        
        $sqlproduk = $con->query("SELECT * FROM produk WHERE NamaProduk = '$namaProduk'");
        $produk = mysqli_fetch_assoc($sqlproduk);
        $idproduk = $produk['ProdukID'];
        $stok = $produk['Stok'];
        $tambahPesanan = mysqli_query($con, "INSERT INTO detailpenjualan VALUES ('$DetailID', '$PenjualanID', '$idproduk', '$jumlah', '$totalHarga')");
        
        // Mengurangi Stok ketika membeli
        $sisaStok = $stok - $jumlah;
        $sisaStok = mysqli_query($con, "UPDATE produk SET stok=$sisaStok");
        if ($tambahPesanan) {
            $_POST['namaProduk'] = "";
            $_POST['harga'] = "";
            $_POST['jumlah'] = "";
            echo "
                <script>
                    alert('Berhasil ditambahkan');
                    window.location.href='index.php?page=transaksi';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Gagal');
                    window.location.href='index.php?page=transaksi';
                </script>
            ";
        }
    }

    $sqlhargaTotal = $con->query("SELECT * FROM detailpenjualan WHERE PenjualanID = '$PenjualanID'");
    $totalHarga = 0;
    while ($data = $sqlhargaTotal->fetch_assoc()) {
        $subtotal = $data['Subtotal'];
        $totalHarga = $totalHarga + $subtotal;
    }

    $date = date('Y-m-d');
    if (isset($_POST['print'])) {
        $namaPelanggan = $_POST['namaPelanggan'];
        
        $tambahPelanggan = mysqli_query($con, "INSERT INTO pelanggan VALUES ('$PelangganID', '$namaPelanggan', '', '')");

        $tambahPenjualan = mysqli_query($con, "INSERT INTO penjualan VALUES ('$PenjualanID', '$date', '$totalHarga', '$PelangganID')");

        $produkTerjual = 0;
        if ($tambahPelanggan && $tambahPenjualan) {
            echo "
            <script>
                alert('Berhasil');
                window.location.href='print.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Gagal');
                window.location.href='index.php?page=transaksi';
            </script>
            ";
        }
    }
    
?>

    <div class="container" style="margin-top: 20px;" >
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-8 well">
                <h2>Transaksi</h2>
                    <div class="form-group col-sm-6">
                        <p for="" class="form-label">No Transaksi :  <?php echo $PenjualanID ?></p>
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class="form-group">
                            <label for="">Pilih Barang</label>
                            <?php
                                include "koneksi/koneksi.php";
                                $result = mysqli_query($con,"select * from produk");
                                $jsArray = "var prdName = new Array();\n";

                                echo '
                                    <select name="namaProduk" class="form-control" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]">
                                    <option>Pilih Barang</option>';
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '
                                        <option value="' . $row['NamaProduk'] . '">' . $row['NamaProduk'] . '</option>';
                                        $jsArray .= "prdName['" . $row['NamaProduk'] . "'] = '" . addslashes($row['Harga']) . "';\n";
                                }
                                echo '
                                </select>';
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Harga</label>
                            <input type="text" class="form-control" name="harga" id="prd_name">
                        </div>
                        <script type="text/javascript">
                            <?php echo $jsArray?>
                        </script>
                        <div class="form-group col-md-6">
                            <label for="">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <button type="submit" name="pesan" class="btn btn-block btn-primary col-lg-4">Pesan</button>
                        </div>
                        <div class="col-md-5"></div>
                        
                    </div>
                
            </div>
            <div class="col-md-4 well">
                <h3>Total</h3>
                <h1 class="card-header">Rp. <?php echo number_format($totalHarga); ?></h1>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container ">
        <h3>Daftar Pembelian</h3>
        <div class="table-responsive">
            <table class="table" id="dataTable" border="1" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        $sql = $con->query("SELECT * FROM detailpenjualan WHERE PenjualanID = '$PenjualanID'");
                        while ($data= $sql->fetch_assoc()) {
                            $produkid = $data['ProdukID'];
                            $sql2 = $con->query("SELECT * FROM produk WHERE ProdukID = '$produkid'");
                    ?>
                    <tr>
                    <td class="text-center"><?php echo $no++ ?></td>
                        <?php 
                            while ($data2=$sql2->fetch_assoc()) {    
                        ?>
                        <td class="text-center"><?php echo $data2['NamaProduk'] ?></td>
                        <td class="text-center">Rp. <?php echo number_format($data2['Harga'])?></td>

                        <?php } ?>
                        <td class="text-center"><?php echo $data['JumlahProduk']?></td>
                        <td class="text-center" name="subtotal">Rp. <?php echo number_format($data['Subtotal'])?></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total Harga:</strong></td>
                        <td class="text-center" id="totalHarga">
                            <?php
                                echo 'Rp. ' . number_format($totalHarga);
                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="form-group col-md-6">
            <label for="" class="form-label">Maukkan Nama Anda</label>
            <input type="text" class="form-control" name="namaPelanggan" id="">
        </div>
        <br>
        <div class="well row">
                <div class="form-group col-md-6">
                    <button name="print" class="btn btn-block btn-primary">Print</button>
                </div>
                <div class="form-group col-md-6">

                </div>
        </div>
        </form>
    </div>