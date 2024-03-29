<?php
require_once('customer/template/version1/header.php');
$subTitle = "Cart";
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	if (isset($_SESSION['cart'][$id])) {
		if (isset($_GET['up'])) {
			$_SESSION['cart'][$id] += 1;
		}else{
			$_SESSION['cart'][$id] -= 1;
			if ($_SESSION['cart'][$id] < 0) {
				$_SESSION['cart'][$id] = 0;
			}
		}
		
	}else{
		$_SESSION['cart'][$id] = 1;
	}
	header("Location:index.php?s=invoices&act=cart");
	
}
if (isset($_SESSION['user'])) {
	$userid = $_SESSION['user']['id'];
	$user_sql = "SELECT name,phone,address FROM customers WHERE id = '$userid' ";
	$query = mysqli_query($connection,$user_sql);
	$userinfo = mysqli_fetch_assoc($query);
}

?>
<style>
	.cart{
		height: 100%;
		overflow-x:scroll;
	}
	table{
		float: left;
		width: 80%;
	}

	table,th,tr,td{
		border: 1px solid #eee;
		border-collapse: collapse;
		text-align: center;
	}
	th{
		text-align: center;
	}
	.btn-q{
		padding: 5px;
		border: 0;
		margin: 5px;
		font-weight: bold;

	}
	.btn-q i{
		font-size: 17px;
		color:black;
	}
	.imgcart{
		width: 100px;
		height: 70px;
	}
	.buy{
		margin-left: 1%;
		width: 18%;
		float: left;
		border: 1px solid #eee;
	}
	.buy button{
		width: 100%;
		background: none;
		border: 1px solid #eee;
		padding: 10px;
		font-weight: bold;
	}
	.buy button:hover{
		color: red;
	}
	.buy form input{
		box-sizing: border-box;
		width: 100%;
		border:0;
		border-bottom: 1px solid #eee;
		border-top: 1px solid #eee;
		padding: 10px;
	}
	span{
		font-size: 13px;
		color:#aaa;
	}
	h4{
		text-align: left;
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
	td button{
		background: none;
		border:0;
	}
	td button i:hover{
		border:1px;
	}
	td button i{
		font-size: 30px;
		color:red;
	}
	@media only screen and (max-width: 768px){
		table{
			width: 100%;
			float: none;
		}
		.buy{
			width: 100%;
		}
	}
</style>
<div class="cart">
	<h1>Cart</h1>
	<?php print_r( $_SESSION['cart']);?>
	<table>

		<tr>
			<th>No</th>
			<th>Product</th>
			<th>Detail</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Total</th>
			<th></th>
		</tr>
		
		<?php
		$count = 0;
		$total = 0;
		foreach ($_SESSION['cart'] as $id => $quantity) {
			$count +=1;
			$sql = "SELECT products.id,products.product_name, products.product_price, sku.sku, sku.color_id, sku.size_id,sku.quantity FROM sku INNER JOIN products WHERE sku.id = '$id' AND products.id = sku.product_id";
			$query = mysqli_query($connection,$sql);
			$row = mysqli_fetch_assoc($query);
			$product_id = $row['id'];
			$img = mysqli_fetch_assoc(mysqli_query($connection,"SELECT url FROM products_images WHERE id ='$product_id'"));
			$quantity_product = $row['quantity'];
			if ($quantity > $quantity_product) {
				$quantity = $quantity_product;
			}
			$name = $row['product_name'];
			$price = $row['product_price'];
			$color_id = $row['color_id'];
			$size_id = $row['size_id'];
			$getColor = mysqli_fetch_assoc(mysqli_query($connection,"SELECT value FROM colors WHERE id ='$color_id'"));
			$getSize = mysqli_fetch_assoc(mysqli_query($connection,"SELECT name FROM sizes WHERE id ='$size_id'"));
			echo "<tr>";
			echo "<td> $count </td>";
			echo "<td>". $name ."<br><a href='?s=products&act=detail&id=$product_id'><img class='imgcart' src='./public/img/product/".$img['url']."'></a></td>";
			echo "<td>";
			echo "Product Code: ".$row['sku']."<br>";
			echo "Color: ".$getColor['value']."<br>" ;
			echo "Size: ".$getSize['name'];
			echo "</td>";
			echo "<td> ".number_format($price,0,'','.')." $</td>";
			echo "<td>";

			echo "<a href='?s=invoices&act=cart&id=$id&down'><button class='btn-q'><i class='fa fa-minus'></i></button></a>";
			echo $quantity;
			if ($quantity == $quantity_product) {
				echo "<a href='#'><button class='btn-q' type='buttom'><i class='fa fa-plus'></i></button></a>";
			}else{
				echo "<a href='?s=invoices&act=cart&id=$id&up'><button class='btn-q'><i class='fa fa-plus'></i></button></a>";
			}
			
			echo "</br>Quantity remaining:" .$quantity_product;
			echo "</td>";
			echo "<td>".number_format($price * $quantity,0,'','.')."$ </td>";
			$total += ($price * $quantity);
			echo "<td>";
			if (isset($_POST['btn'])) {
				$id_cart = $_POST['id'];
				unset($_SESSION['cart'][$id_cart]);
				header("Location:index.php?s=invoices&act=cart");
			}
			echo "<form action='index.php?s=invoices&act=cart' method ='POST'>";
			echo "<input type='hidden' name='id' value='$id'>";
			echo "<button name='btn'><i class='fa fa-times-circle'></i></button>";
			echo "</form>";
			echo "</td>";
			echo "</tr>";


		} 
		?>
		<tr>
			<td colspan="7">Total Pay : <?php echo number_format($total,0,'','.') ?> $</td>
			
		</tr>
		
	</table>
	<div class="buy">
		<button onclick="window.location.replace('?s=home')">Continue Shopping</button><br>
		<?php if (isset($_SESSION['user'])): ?>
			<form action="index.php?s=invoices&act=checkout" method="POST">
				<span>Receiver Name:</span>
				<input type="text" placeholder="Name" name="receiver_name"value="<?php echo $userinfo['name'] ?>"><br>
				<span>Receiver PhoneNumber:</span>
				<input type="number" name="receiver_phone" placeholder="Phone" value="<?php echo $userinfo['phone'] ?>"><br>
				<span>Receiver Address:</span>
				<input type="text" name="receiver_address" placeholder="Address" value="<?php echo $userinfo['address'] ?>"><br>

				<input type="hidden" name="total_amount" value="<?php echo $total ?>" >
				<span>Receiver Note:</span>
				<input type="text" name="receiver_note" placeholder="Note" value="">
				<?php if ($total == 0): ?>
					<button type ="button" name="btnCheckOut">Checkout</button>
					<?php else: ?>
						<button name="btnCheckOut">Checkout</button>
					<?php endif ?>
				</form>
				<?php else: ?>
					<Button onclick="window.location.replace('?s=home&act=login&checkout')">Login To Checkout</Button>
				<?php endif ?>
				
			</div>	

		</div>
		<?php 
		require_once('customer/template/version1/footer.php'); ?>