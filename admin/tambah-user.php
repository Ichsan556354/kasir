<div class="row well">
        <div class="col-md-4">
            <div class="card well">
                <div class="card-header">
                    <h3 class="">Tambah User</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3 mt-3">
                            <label for="nama" class="form-label">ID User:</label>
                            <input type="text" class="form-control" id="id" placeholder="Enter Name" name="id">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nama" class="form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" placeholder="Enter Name" name="NamaUser">
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="Password">
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Password:</label>
                            <select type="password" class="form-control" id="pwd" placeholder="Enter password" name="level">
                                <option value="Administrator">Administrator</option>
                                <option value="Petugas">Petugas</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php 
    include_once("../koneksi/koneksi.php");
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
		$name = $_POST['NamaUser'];
		$password = md5($_POST['Password']);
        $level = $_POST['level'];
		
		// Insert user data into table
		$result = mysqli_query($con, "INSERT INTO user (UserID, NamaUser, Password, level) VALUES('$id','$name','$password', '$level')");
		
		// Show message when user added
		
        echo "<script>
            alert('User baru berhasil ditambahkan');
            window.location.href='?page=user';
        </script>";

	}


?>
