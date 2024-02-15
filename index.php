<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logo</a>
            <div class="justify-content-center collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=transaksi">Transaksi</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=tes">Daftar Barang</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
        if (isset($_GET['page'])) {
            $laman = $_GET['page'];
            
            switch ($laman) {
                case 'transaksi':
                    include "transaksi1.php";
                    break;

                case 'tes':
                    include "tes.php";
                    break;

                case 'daftar-menu':
                    include "daftar-menu.php";
                    break;

                default:
                    # code...
                    break;
            }
        }
    ?>
</body>
</html>
