<?php
    include "koneksi/koneksi.php";
    
    $query = mysqli_query($con, "SELECT max(PenjualanID) as kodeTerbesar FROM penjualan");
    $data = mysqli_fetch_array($query);
    $kodeBarang = $data['kodeTerbesar'];
    
    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kodeBarang, 3, 3);
    
    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;
    
    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = "421";
    $kodeBarang = $huruf . sprintf("%03s", $urutan);
?>
    <div class="container" style="margin-top: 20px;"style="background-color: aliceblue;">
        <div class="row">
            <div class="col-md-8 well">
                <h2>Transaksi</h2>
                <form action="" method="POST">
                    <div class="form-group col-sm-6">
                        <p for="" class="form-label">No Transaksi</p>
                        <input type="number" name="noTransaksi" class="form-control" disable="disable" value="<?php echo $kodeBarang ?>" id="" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="form-label">Maukkan Nama Anda</label>
                        <input type="text" class="form-control" name="namaPelanggan" id="">
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
                    <div class="form-group col-md-5 row">
                        <button class="btn btn-block btn-warning col-lg-6 mx-2">Tambah pesan</button>
                        <button type="submit" name="pesan" class="btn btn-block btn-primary col-lg-4">Pesan</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 well" >
                <h3>Total</h3>
                <h1 class="card-header">Rp. 30.000</h1>
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
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                                $no = 1;
                                $sql = $con->query("SELECT * FROM detailpenjualan");
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
                        <td class="text-center">Rp. <?php echo number_format($data['Subtotal'])?></td>
                        <td class="text-center" width="18%">
                            <a href="#" class="btn btn-block btn-sm btn-primary col-md-4">Edit</a>
                            <a href="#" class="btn btn-block btn-sm btn-danger col-md-4 ">Hapus</a>
                        </td>
                                
                    </tr>
                    <?php  } ?>
                        
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total Harga:</strong></td>
                        <td id="totalHarga">0</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

<?php 
    $query = mysqli_query($con, "SELECT max(DetailID) as kodeTerbesar FROM detailpenjualan");
    $data = mysqli_fetch_array($query);
    $kodeBarang = $data['kodeTerbesar'];
    
    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kodeBarang, 3, 3);
    
    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya 
    $urutan++;
    
    // membentuk kode barang baru 
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = "111";
    $kodeDetail = $huruf . sprintf("%03s", $urutan);
    if (isset($_POST['pesan'])) {
        $idPenjualan = $_POST['noTransaksi'];
        
        $namaProduk = $_POST['namaProduk'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $totalHarga = $harga * $jumlah;

        $sqlproduk = $con->query("SELECT * FROM produk WHERE NamaProduk = '$namaProduk'");
        while ($produk = mysqli_fetch_array($sqlproduk)) {
            $idproduk = $produk['ProdukID'];
            $tambahPesanan = mysqli_query($con, "INSERT INTO detailpenjualan VALUES ('$kodeDetail', '$idPenjualan', '$idproduk', '$jumlah', '$totalHarga')");
        }
        $_POST['namaProduk'] = "";
        $_POST['harga'] = "";
        $_POST['jumlah'] = "";
    }
?>
