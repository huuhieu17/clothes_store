<?php 
require_once 'template/header.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
	$sql = "DELETE FROM categorizes WHERE id='$id'";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo "Error",mysqli_connect_error();
	}else{
		header("Location:?modules=products&action=all");
	}
?>