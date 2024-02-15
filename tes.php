<?php
include "koneksi/koneksi.php";
?>
<div class="container" style="margin-top: 20px;"style="background-color: aliceblue;">
        <div class="row">
            <div class="col-md-8 well">
                <h2>Transaksi</h2>
<form name='autoSumForm' action='' method='post'>
 <h5>Tabel Harga Barang</h5>
 <table width='25%' style='margin-left:1%' border='1px'>
 <tr>
 <td>Nama Barang</td>
 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <?php 
    $result = mysqli_query($con,"select * from produk");
    $jsArray = "var prdName = new Array();\n";
    echo '
   <select name="pengeluaran" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]">
   <option>Pilih Barang</option>';
     while ($row = mysqli_fetch_array($result)) {
   echo '
  <option value="' . $row['NamaProduk'] . '">' . $row['NamaProduk'] . '</option>';
   $jsArray .= "prdName['" . $row['NamaProduk'] . "'] = '" . addslashes($row['Harga']) . "';\n";
     }
     echo '
     </select>';
    ?>
    </td>
   </tr>
   <tr>
 <td>Harga</td>
 <label>Rp.</label>&nbsp;&nbsp;<input type="text" name="harga" id="prd_name">
    <script type="text/javascript">
    <?php echo $jsArray; ?>
    </script>    
   </tr>
  </table>
</form>

        </div>
    </div>
</div>

$sql = mysqli_query($con, "SELECT * FROM produk");
                                $jsArray = "var prdName = new Array();\n";
                            ?>
                            <select class="form-control" name="namaProduk" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]">
                                <?php 
                                
                                    
                                    while ($data= mysqli_fetch_array($sql)) { 
                                ?>
                                <option value="<?php echo $data["NamaProduk"]; ?>"><?php echo $data["NamaProduk"]?></option>

                                <?php
                                    $jsArray .= "prdName['" . $row['NamaProduk'] . "'] = '" . addslashes($row['Harga']) . "';\n";
                                } ?>