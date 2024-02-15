<?php
include_once("../koneksi/koneksi.php");
 
if(isset($_POST['update']))
{	
	$id = $_GET['UserID'];
	
	$name=$_POST['name'];
	$password= md5($_POST['password']);
    $level = $_POST['level'];
	// update user data
	$result = mysqli_query($con, "UPDATE user SET NamaUser='$name', Password='$password', level='$level' WHERE UserID=$id");
	
	header("Location: index.php?page=user");
    echo "<script>alert('berhasil');.windows.</script>";
}


$id = $_GET['UserID'];

$result1 = mysqli_query($con, "SELECT * FROM user WHERE UserID=$id");

while($user_data = mysqli_fetch_array($result1))
{
	$name = $user_data['NamaUser'];
	$password = $user_data['Password'];
	$level = $user_data['level'];
}
?>

<div class="row well">
        <div class="col-md-4">
            <div class="card well">
                <div class="card-header">
                    <h3 class="">Update User</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        
                        <div class="mb-3 mt-3">
                            <label for="nama" class="form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" value="<?php echo $name; ?>" placeholder="Enter Name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="pwd" value="<?php echo $password; ?>" placeholder="Enter password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Level:</label>
                            <select class="form-control" id="pwd" placeholder="Enter password" name="level">
                                <option value="Administrator">Administrator</option>
                                <option value="Petugas">Petugas</option>
                            </select>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
