<header class="bg-dark text-light py-5">
        <div class="container">
            <h1 class="text-center">Selamat Datang di Website Sembako Barokah Online</h1>
            <p class="lead text-center">Buka Halaman Transaksi untuk membeli produk Kami</p>
        </div>
    </header>
    
    <div class="container mt-5">
        <section>
            <h2 class="text-center mb-4">Daftar Produk yang tersedia</h2>
        </section>

        <style>
  .main-content {
    margin-top: 60px;
  }
  .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .card {
        margin-bottom: 20px;
    }
</style>
        <div class="main-content">
            <div class="card-container">
                <?php
                include "koneksi/koneksi.php";
                $sql = $con->query("SELECT * FROM produk");
                while ($data= $sql->fetch_assoc()) {
                    ?>
                    <div class='card' style='width: 16rem; margin: 10px;'>
                    
                        <?php echo "<img class='card-img-top' src='image/" . $data['foto'] . "' width='230' height='250'>" ?>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $data['NamaProduk']?></h5>
                            <p class='card-text'>Harga: RP.<?php echo  number_format($data['Harga']) ?></p>
                            <p class='card-text'>Stok: <?php echo $data['Stok']?></p>
                            <a href='?page=transaksi' class='btn btn-md btn-primary float-end'>Beli</a>
                        </div>
                    
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-light py-4">
        <div class="container text-center">
            <p>Hak Cipta &copy; 2024 | SB Online</p>
        </div>
    </footer>