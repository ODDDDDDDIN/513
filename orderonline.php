<?php
session_start();




 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: http://localhost/2/login");
    exit;
}

include 'DBController.php';
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Fodder Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
<!-- FlexSlider -->
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
$(window).load(function(){
  $('.flexslider').flexslider({
	animation: "slide",
	start: function(slider){
	  $('body').removeClass('loading');
	}
  });
});
</script>
<!-- //FlexSlider -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<link href='http://fonts.useso.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Anton' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
</head>
	
<body>
<!-- banner-body -->
	<div class="banner-body">
		<div class="container">
			<!-- banner -->
				<div class="banner">
					<div class="col-md-3 banner-left">
						 <ul class="menu">
							<li class="item1"><a href="#"><img class="arrow-img" src="images/menu.png" alt=""/></a>
								<ul class="cute">
									<li><a href="index.html" class="active">Home</a></li>
									<li><a href="aboutus.html">About Us</a></li>
									<li><a href="upload.php">Careers</a></li>
									<li><a href="orderonline.php">Orderonline</a></li>
									<li><a href="contactus.html">Contact us</a></li>
									<li><a href="crud4.php">Membership registration</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="col-md-9 banner-right">
						<a href="index.html"><img src="images/logo.png" alt=" " /></a>
					</div>
					<div class="clearfix"> </div>
				</div>
					<!--initiate accordion-->
					<script type="text/javascript">
						$(function() {
							var menu_ul = $('.menu > li > ul'),
								   menu_a  = $('.menu > li > a');
							menu_ul.hide();
							menu_a.click(function(e) {
								e.preventDefault();
								if(!$(this).hasClass('active')) {
									menu_a.removeClass('active');
									menu_ul.filter(':visible').slideUp('normal');
									$(this).addClass('active').next().stop(true,true).slideDown('normal');
								} else {
									$(this).removeClass('active');
									$(this).next().stop(true,true).slideUp('normal');
								}
							});
						
						});
					</script>
			<!-- //banner -->
			<a href="http://localhost/2/logout.php" class="button3">Sign Out of Your Account</a>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="orderonline.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="orderonline.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
	
		<div class="image">
			
			<div class="image"><img src="<?php echo $product_array[$key]["image"]; ?>"/>
			<button class="quick_look" data-id="<?php echo $product_array[$key]["id"] ; ?>">Quick Look</button>
			</div>
			<form method="post" action="orderonline.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			
			</form>
			
		</div>
	<?php
		}
	}
	
	?>
</div>
</div>		

		
						
				<!--script-->
					<script src="js/jquery.chocolat.js"></script>		
					<!--light-box-files -->
					<script type="text/javascript">
					$(function() {
								$('.img-top a').Chocolat({overlayColor:'#000',leftImg:'images/leftw.gif',rightImg:'images/rightw.gif',closeImg:'images/closew.gif'});
							});
					</script>
							</div>
						</div>
					<!-- //menu -->
					<!-- reserve -->
						
					<!-- //reserve -->
					<!-- contact -->
						<div id="contact" class="contact">
							<iframe src="" frameborder="0" style="border:0" allowfullscreen=""></iframe>
							<div class="map-color">
							</div>
							<div class="map-grids">
								
								<div class="inp-form">
									
								</div>
								<h4>Newsletter</h4>
								<p>Enter your email and subscribe to our newsletter and never miss any updates</p>
								<div class="mail-sub">
									<form>
										<input type="email" value="Email Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email Address';}" required="">
										<input type="submit" value="">
										<div class="clearfix"> </div>
									</form>
								</div>
								<div class="footer">
									<div class="footer-left">
										<p>lsf<a target="_blank" href=""></a></p>
									</div>
									<div class="footer-right">
										<ul>
											<li><a href="#" class="facebook"> </a></li>
											<li><a href="#" class="twitter"> </a></li>
											<li><a href="#" class="p"> </a></li>
											<li><a href="#" class="g"> </a></li>
										</ul>
									</div>
									<div class="clearfix"> </div>
								</div>
							</div>
						</div>
					<!-- //contact -->
				</div>
			<!-- //about -->
			
		</div>
	</div>
<!-- //banner-body -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>