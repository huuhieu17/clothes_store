<?php
	$sql = "SELECT * FROM brands";
	$query_brand = mysqli_query($connection,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="public/img/template/favicon.ico" type="image/gif" sizes="16x16">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>HStore - Making you to Shine</title>
	<style>
		*{
			margin: 0;
			padding: 0;
			font-family: sans-serif;
			box-sizing: border-box;
		}
		body{
			width: 100%;
			height: 100%;
			background: #f1f1f1 url(public/img/template/bg-v3.png) center top;
		}
		#container{
			position: relative;
			width: 100%;
/*			background: gray;*/
			height: 100vh;

		}
		#header{
			position: fixed;
			z-index: 999;
			padding: 0 8%;
			box-sizing: border-box;
			width: 100%;
			background: white;
			height: 8%;
		}
		#header:hover{
			border-bottom: 1px solid black;
		}
		#left{
			height: 100%;
			width: 50%;
			float: left;
			box-sizing: border-box;
		}
		#right{
			height: 100%;
			width: 50%;
			float: left;
			box-sizing: border-box;
		}
		#llogo{
			box-sizing: border-box;
			background: url(public/img/template/logo.png);
			background-position: left;
			background-size:contain;
			background-repeat: no-repeat;
			cursor: pointer;
			width: 30%;
			height: 100%;
			float: left;
		}
		#lcontent{
			width: 69%;
			height: 100%;
			float: left;
		}
		.drop{
			height: 100%;
		    padding: 3%;
		    /* margin: 0 1%; */
		    float: left;
		}
		.drop:hover{
			background: #f5f5f5;
		}
		.drop:hover button{

		}
		.drop .dropbtn{
			margin: 0 1%;
			border: 0;
			padding: 5%;
			background: none;
			height: 100%;
			text-align: center;
			color: black;
			font-weight: bold;
			font-size: 14px;
			outline: none;
			text-transform: uppercase;
		}
		a.link{
			box-sizing: border-box;
			transition: 0.7s;
			text-align: center;
			padding: 5%;
			height: 100%;
			color: black;
			float: left;
			font-weight: bold;
			font-size: 14px;
			text-decoration: none;
			font-family: sans-serif;
			margin: 0;
			text-transform: uppercase;
		}
		a:hover, .drop .dropbtn:hover{
			background: #f5f5f5;
		}
		.drop .drop-content{
			    display: none;
			    margin: 1% -0.9%;
			    min-width: 20%;
			    position: absolute;
		}
		.drop .drop-content a.dropdown{
			transition: 0.7s;
			font-size: 11px;
			 float: none;
			 color: black;
			 padding: 7px;
			 text-decoration: none;
			 display: block;
			 text-align: left;
			 text-transform: uppercase;
		}
		.drop:hover .drop-content{
			display: block;
			background: lightgray;
		}
		#right #search{
			display: block;
			padding: 2%;
			float: left;
			width: 50%;
		}
		#right #search input{
			padding: 2%;
			border:1px solid gray;
			width: 70%;
		}
		#right #search button{
			color: white;
			padding: 2%;
			border:1px solid gray;
			background: black;
			
		}

		#right #action{
			height: 100%;
			padding: 3%;
			box-sizing: border-box;
			text-align: right;
			width: 45%;
			float: right;
		}
		
		#right #action a{
			margin: 0 3%;
			text-decoration: none;
			color: black;
			transition: 0.7s;
		}
		#right #action a:hover{
			padding: 5%;
			height: 100%;
		}
		#right #action a.act{
			margin: 0 3%;
			text-decoration: none;
			color: black;
			
		}
		#right #action a:hover{
			color: black;
			background:#f5f5f5;
		}
		ul{

			text-align: left;
			list-style-type: none;
		}
		ul li{
			float: left;
			transition: 0.7s;
		}
		ul li ul{
			padding: 1% 0;
			position: absolute;
			display: none;
		}
		ul li ul li{
			transition: 0.7s;
			float: none;
			padding: 10px 0;
			background: white;
		}
		ul li:hover ul {
		    width: 17.5%;
		    box-sizing: border-box;
		    overflow: hidden;
		    text-align: left;
		    display: block;
		    /* padding: 0% 0; */
		    padding: 2% 0;
		}
		ul li ul li a{
			display: block;

		}
		ul li ul li a:hover{

		}
		#menuicon{
			display: none;
		}
		.content{
			padding: 4% 8%;
			height: 100%;
		}
		/*Mobile	*/
		@media screen and (max-width: 320px) {
			#header{
				
			}
			#llogo{
				display: block;
			}
			#menuicon{
			 display: block;
			 float: right;
			 padding: 1%;
			 }
			#left #lcontent{
				position: relative;
				display: none;
				float: right;
				background:white;
			}
			#right{
				display: none;
			}
			#lcontent a{
				display: block;
				background:white;
			}
			#lcontent .drop{
				background:white;
				width: 100%;
			}
			.temp{
  			display: block;
			}
		}

	</style>

</head>
<body>
	<div id="container">
		<!-- Header -->
		<div id="header" class="nav">
			<a id="menuicon" href="#" onclick="drop();"><i class="fa fa-bars"></i></a>
			<div id="left">
				<div id="llogo" onclick="window.location.replace('?s=home')">
					
				</div>
				<div id="lcontent">
					<a href="#" class="link">News </a>
				<div class="drop">
					<button class="dropbtn">Brands</button>
					<div class="drop-content">
						<?php foreach ($query_brand as $key): ?>
							<a href="?s=products&act=brand&id=<?php echo $key['id']?>" class="dropdown"><?php echo $key['name'];?></a>
						<?php endforeach?>
					</div>
				</div>
				
				<div class="drop">
					<button class="dropbtn">Clothes</button>
					<div class="drop-content">
						<a href="#" class="dropdown">Thương Hiệu</a>
						<a href="#" class="dropdown">Thương Hiệu</a>
						<a href="#" class="dropdown">Thương Hiệu</a>
					</div>
				</div>
				</div>
			</div>
			<div id="right">
				<div id="search">
					<form action="index.php?s=products&act=search" method="GET">
						<input type="text" placeholder="Keyword" name="keyword"><button><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div id="action">
					<?php 
						if (!isset($_SESSION['user'])|| $_SESSION['user'] === "") {
							echo "<a href='?s=home&act=login'><i class='fa fa-user-circle'></i> Login</a>";
						}else{
							echo "
							<ul>
								<li>".$_SESSION['user']['name']."
									<ul>
										<li><a class='act' href='#'><i class='fa fa-user-o'></i>  Account Information</a></li>
										<li><a class='act' href='index.php?s=home&act=logout'><i class='fa fa-power-off'></i>  Logout</a></li>
									</ul>
								</li>
							</ul>";
						}
					?>
					<a href="#"><i class="fa fa-shopping-cart"></i> Cart</a>
					
					
					
					
				</div>
			</div>
			
			
			
		</div>
		<div class="content">
			
		
	