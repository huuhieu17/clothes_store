<?php
require_once("customer/config/session.php");
require_once('customer/config/config.php');
$sql = "SELECT * FROM `brands`";
$query_brand = mysqli_query($connection,$sql);
$title = "Hstore - Making you to Shine";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	
	<style>
		html {
			scroll-behavior: smooth;
		}
		*{
			padding: 0;
			margin: 0;
			font-family: 'Open Sans', sans-serif;
		}
		body{
			height: 100%;
		}
		#container{
			position: relative;
			width: 100vw;
			height: 100%;
		}
		#container .topnav{
			box-sizing: border-box;
			z-index: 99;
			top: 0;
			position: sticky;
			width: 100%;
			height: 7%;
			background: white;
			border-bottom: 2px solid #eee;
		}
		#container  #header #left{
			padding: 8px;
			background: white;
			cursor: pointer;
			width: 20%;
			height: 100%;
			box-sizing: border-box;
			float: left;
			top: 0;
			bottom: 0;
		}
		#container  #header #left img{

		}
		#container #header #right{
			background: white;
			padding-right: 20px;
			box-sizing: border-box;
			width: 80%;
			height: 100%;
			float: right;
			text-align: right;
		}
		ul{
			box-sizing: border-box;
			position: relative;
			float: right;
			display: flex;
			flex-wrap: wrap;
			list-style-type: none;
		}
		ul li{
			box-sizing: border-box;
			padding: 20px;
			display: list-item;
		}
		ul li a{
			display: block;
			width: 100%;
			font-size: 13px;
			/*padding: 10px;*/
			color: black;
			text-decoration: none;
			text-transform: uppercase;
		}
		ul li:hover{
			position: relative;
			background: #f1f1f1;
		}
		ul li ul{
			width: 300%;
			text-align: left;
			top: 101%;
			left: 0;
			background: white;
			position: absolute;
			display: none;
		}
		ul li ul li{
			background: #f1f1f1;
		}
		ul li ul li:hover{
			background: white;
		}
		ul li ul li a:hover{
			font-weight: bold;
			transition: 0.1s;
			background: white;
		}
		ul li ul li a{
			width: 100%;
		}

		ul li:hover ul{
			display: block;
		}
		#search input{
			box-sizing: border-box;
			display: inline;
			padding: 5px;
		}

		#search button{
			display: inline;
			padding: 5px;
		}
		#footer{
			box-sizing: border-box;
			position: relative;
			width: 100%;
			height: 10%;
			background: #000;
			color: white;
			padding: 20px;
			bottom:0;
		}
		
		#menu{
			padding: 8px;
			border: none;
			background: none;
			outline: none;
			display: none;
			box-sizing: border-box;
		}
		#logout{
			display: none;
		}
		#content{
			overflow: hidden;
			width: 100vw;
			height: 80%;
			margin-bottom: 50px;
		}
		@media only screen and (min-width: 490px) and (max-width: 766px){
		}
		@media only screen and (max-width: 768px) {
			#header{
			}
			ul{
				width: 100%;
				display: none;
				margin: 0;
				padding: 0;
			}
			ul li ul li{
				display: none;
			}
			ul li{
				border-bottom: 1px solid #aaa;
				padding: 20px;
				background: white;
				
			}
			ul li:hover{
				background: #eee;
			}
			ul li a{
				width: 100%;
				height:100%;
				background: none;
				color: black;
			}
		}
		
		@media only screen and (max-width: 768px) {
			.modal-content{
				width: 80%;
			}
			
			
			#menu{
				font-size: 23px;
				float: right;
				display: block;
			}
			#container  #header #left{
				padding: 8px;
				width: 100%;
			}
			#right{
			}
			
			#left img{

				float: left;
			}
			.responsive {position: relative;}
			.topnav.responsive ul {
				display: block;
				text-align: right;
				float: right;
				width: 125%;
			}
			.topnav.responsive ul li ul{
				display: none;
			}
			#logout{
				display: block;
			}
			#search form input{
				width: 80%;
				padding: 15px;
			}
			#search form button{
				/*width: 90%;*/
				padding: 15px;
			}
		}
		#myBtn {
			display: none; /* Hidden by default */
			position: fixed; /* Fixed/sticky position */
			bottom: 20px; /* Place the button at the bottom of the page */
			right: 0px; /* Place the button 30px from the right */
			z-index: 99; /* Make sure it does not overlap */
			border: none; /* Remove borders */
			outline: none; /* Remove outline */
			background-color: #19b5acc7; /* Set a background color */
			color: white; /* Text color */
			cursor: pointer; /* Add a mouse pointer on hover */
			padding: 15px; /* Some padding */
			border-radius: 10px; /* Rounded corners */
			font-size: 15px; /* Increase font size */
		}

		#myBtn:hover {
			background-color: #555; /* Add a dark-grey background on hover */
		}

	</style>
</head>
<body>
	<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution="setup_tool"
        page_id="221741658253695"
  theme_color="#ff7e29">
      </div>
	<div id="container">
		<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
		<div id="header" class="topnav">
			<div id="left">
				<button id="menu" onclick="menu()"><i class="fa fa-bars"></i></button>
				<img onclick="window.location.replace('?s=home')" src="public/img/template/logo.png" alt="">
			</div>
			<div id="right">
				<ul>
					<li id="search">

						<input type="text" placeholder="Search" name="keyword" id="svalue" value = ""><button onclick="search()"><i class="fa fa-search"></i></button>
						<script type="text/javascript">
							function search(){
								var svalue = document.getElementById('svalue').value;
								window.location.replace('?s=products&act=search&keyword='+ svalue) ;
							}
						</script>
							<!-- <form action="">
								<input type="text" name="keyword"> <button>Search</button>
							</form> -->
							
						</li>
						<li><a href="?s=products&act=brand">Brand</a>
							<ul>
								<?php foreach ($query_brand as $key): ?>
									<li><a href="?s=products&act=brand&id=<?php echo $key['id'] ?>"><?php echo $key['name']; ?></a></li>
								<?php endforeach?>
							</ul>
						</li>
						<li><a href="?s=products&act=type">Type</a>
							<ul>
								<?php
								$sql = "SELECT * FROM categorizes";
								$query = mysqli_query($connection,$sql);
								foreach ($query as $key) {
									$id = $key['id'];
									echo "<li><a href='?s=products&act=type&id=$id'>".$key['name']."</a></li>";
								}
								?>
							</ul>
						</li>
						<li><a href="?s=home&act=promo">News</a></li>
						
						<?php 
						if (!isset($_SESSION['user'])|| $_SESSION['user'] === "") {
							echo "<li><a href='index.php?s=home&act=login'>Login</a></li>";
							echo "<li><a href='index.php?s=home&act=register'>Sign Up</a></li>";
						}else{
							echo "<li><a href='?s=account&act=general' style='font-weight:bold;'>".$_SESSION['user']['name']."</a>
							<ul>
							<li><a class='act' href='?s=account&act=general'><i class='fa fa-user'></i>  Account </a></li>
							<li><a class='act' href='?s=invoices&act=history'><i class='fa fa-history'></i>  Order History </a></li>
							<li><a class='act' href='index.php?s=home&act=logout'><i class='fa fa-power-off'></i>  Logout</a></li>
							</ul>
							</li>";
						}
						?>
						<li><a href="?s=invoices&act=cart"><i class="fa fa-shopping-cart"></i>
							<?php 
							$t = 0;
							if (isset($_SESSION['cart'])) {
								foreach ($_SESSION['cart'] as $id => $quantity) {
									$t += $quantity;
								}
								echo "($t)";
							}
							?>
						</a></li>
						<?php 
						if (isset($_SESSION['user'])) {
							echo "<li id='logout'><a class='act' href='index.php?s=home&act=logout'><i class='fa fa-power-off'></i>  Logout</a></li>";
						}
						?>
						
						
					</ul>
				</div>
			</div>
			<div id="content">
				
				
				