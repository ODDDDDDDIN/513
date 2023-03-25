<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address = $salary = $username = $password ="";
$name_err = $address_err = $salary_err = $username_err =$password_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }

    // Validate username
if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
} else{
    // Prepare a select statement
    $sql = "SELECT id FROM employees WHERE username = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        // Set parameters
        $param_username = trim($_POST["username"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $username_err = "This username is already taken.";
            } else{
                $username = trim($_POST["username"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Validate confirm password
if(empty(trim($_POST["password"]))){
    $password_err = "Please confirm password.";     
} else{
    $password = trim($_POST["password"]);
    if(empty($password_err) && ($password != $password)){
        $password_err = "Password did not match.";
    }
}
 
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)&& empty($username_err)&& empty($password_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, salary, username, password) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiss", $param_name, $param_address, $param_salary, $param_username, $param_password);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_username = $username;
            $param_password = $password;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: crud2.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
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
									<li><a href="index.html">Home</a></li>
									<li><a href="aboutus.html">About Us</a></li>
									<li><a href="upload.php">Careers</a></li>
									<li><a href="orderonline.php">Orderonline</a></li>
									<li><a href="contactus.html">Contact us</a></li>
									<li><a href="crud4.php" class="active">Membership registration</a></li>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label for="fname">Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="fname">Address</label>
                            <input type="text" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="fname">Salary</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="fname">Username</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="fname">Password</label>
                            <input type="text" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
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