<?php 

require_once 'template/header.php';
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "SELECT * FROM categorizes WHERE id ='$id' ";
		$query= mysqli_query($connection,$sql);
		$result = mysqli_fetch_assoc($query);
	}
	if (isset($_POST['btn'])) {
		$name = $_POST['name'];
		$id = $_GET['id'];
		$sql = "UPDATE categorizes SET name='$name' WHERE id='$id'";
		$query= mysqli_query($connection,$sql);
		if (!$query) {
			# code...
		}else{
			header('Location:?modules=categorizes&action=all');
		}
	}
?>
<style>
	#contents{
		height: 100vh;
	}
	#addbrand{
		width: 100%;
		background: #f1f1f1;
		margin: auto;
	}
	form{
		box-sizing: border-box;
		padding: 20px;
		background: white;
		width: 50%;
		margin: auto;
	}
	h4{
		text-align: left;
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
	input{

		padding: 10px;
		width: 80%;
	}
	button{
		margin: 10px 0;
		padding: 10px;
		width: 80%;
	}
	a.nav{
		color: gray;
		font-weight: bold;
	}
	@media only screen and (max-width: 768px) {
		form{
			width: 100%;
			text-align: center;
		}
	}
</style>
<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=categorizes&action=all">Product Type</a>/<a class="nav"href="?modules=categorizes&action=edit">Edit</a>
<h4>Edit Type</h4>
<div id="addbrand">
	<form method="POST">
		<span>Product Type</span><br>
	<input type="text" name="name" placeholder="Product Type" value="<?php echo $result['name']?>"><br>
	<button name="btn">Edit</button>
	</form>
</div>
<?php require_once 'template/footer.php'; ?>