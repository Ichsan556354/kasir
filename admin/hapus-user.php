<?php

include_once("../koneksi/koneksi.php");
$id = $_GET['UserID'];
$result = mysqli_query($con, "DELETE FROM user WHERE UserID=$id");
header("Location:index.php?page=user");

?>