<?php
include 'koneksi/koneksi.php';

$query = "SELECT PenjualanID, TanggalPenjualan FROM penjualan ORDER BY PenjualanID DESC LIMIT 1";
$result = mysqli_query($con, $query);
$printPenjualanData = mysqli_fetch_assoc($result);

$PenjualanID = $printPenjualanData['PenjualanID'];

$sqlhargaTotal = $con->query("SELECT * FROM detailpenjualan WHERE PenjualanID = '$PenjualanID'");
$totalHarga = 0;
while ($data = $sqlhargaTotal->fetch_assoc()) {
    $subtotal = $data['Subtotal'];
    $totalHarga = $totalHarga + $subtotal;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="width: 250px;">
        <p align=center>SB Online</p>
        <p>= = = = = = = = = = = = = = = = = = = </p>
        
        <?php
            
        ?>
        <p>Nota :   <?php echo $PenjualanID; ?></p>
        <p>Tgl :    <?php echo $printPenjualanData['TanggalPenjualan']; ?></p>
        

        <p>= = = = = = = = = = = = = = = = = = = </p>

        <table class="table" id="dataTable" width="25%" cellspacing="8">
                <thead>
                    <tr>
                        <td class="text-center">Nama</td>
                        <td class="text-center">Harga</td>
                        <td class="text-center">Jumlah</td>
                        <td class="text-center">Total</td>
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
                        <?php 
                            while ($data2=$sql2->fetch_assoc()) {    
                        ?>
                        <td class="text-center"><?php echo $data2['NamaProduk'] ?></td>
                        <td class="text-center"><?php echo number_format($data2['Harga'])?></td>

                        <?php } ?>
                        <td class="text-center"><?php echo $data['JumlahProduk']?></td>
                        <td class="text-center" name="subtotal"><?php echo number_format($data['Subtotal'])?></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <br>
                    <tr>
                        <td colspan="3"><strong>Total Harga:</strong></td>
                        <td class="" id="totalHarga">
                            <?php
                                echo number_format($totalHarga);
                                
                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <p>= = = = = = = = = = = = = = = = = = = </p>
            <p align=center>*Terima kasih sudah berbelanja</p>
        </div>
<script>
    window.print()
</script>

</body>
</html>