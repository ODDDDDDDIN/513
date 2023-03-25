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
									<li><a href="index.html">Home</a></li>
									<li><a href="aboutus.html">About Us</a></li>
									<li><a href="upload.php" class="active">Careers</a></li>
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
			
			<div class="wrapper">
				<div id="welcome" class="container">
					<div class="title">
						<h1>Join our team</h1>
						<p> We are expanding our branches and need experienced baker regularly.</n>
							Send us your detail with the form below</br>
						and we will be in contact shortly</p>
			
						<div id="three-column" class="container">
					   
							<div class="title">
								<h2>Fill out the form below and upload your
									 cover letter and resume</h2>
								<form action="file_upload.php" method="POST"
						enctype="multipart/form-data">
	
						<label2 for="name">First name:</label2>
						<input type="text" id="name" name="name"/><br>
						<label2 for="email">Last name:</label2>
						<input type="text" id="email"name="email" /><br>
						<label2 for="telephone">Email Address:</label2>
						<input type="text" id="telephone" name="telephone"/><br>
						<label2 for="message">Work experience</label2>
						<textarea name="message" id="message" cols="30" rows="10"></textarea><br />
				<p>
							Select files to upload:
							 
							<!-- name of the input fields are going to
								be used in our php script-->
							<input type="file" name="files[]" multiple><br>
							<input type="file" name="files[]" multiple>
							<br><br>
							 
							<input type="submit" name="submit" value="Upload" >
						</p>
				 
					</form>
								
								</div>
							
								
								
							</div>
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