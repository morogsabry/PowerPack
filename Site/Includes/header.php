<!DOCTYPE html>
<html lang="en">
<head>
	<title>Power Pack</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon
      ================================================== -->
  <link rel="icon" type="image/png" href="images/11.png">

	
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">
	
	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/myedit.css">
<style>
    .nav-item{
        color:#fff;
        background-color:#040e26 ;
        }
    .nav-item a:hover{
        background-color:#fc5e28 ;
        }
    .nav-item a:active{
        background-color: #fc5e28;
        }
		.navbar-right .dropdown-menu{
			min-width: 180px;
            padding: 0px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
		}
		.dropdown-menu>li>a {
            color: #FFF;
            padding: 10px 15px;
        }
		.dropdown-menu>li>a:hover{
			background-color: #040e26;
			color:#FFF
		}
	
</style>
</head>
<body>
<?php
	include 'init.php';
	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
	if($do == 'Manage'){
	 $stmt2 = $con->prepare("SELECT * FROM contactus ");
	 $stmt2->execute();  
	 $rows = $stmt2->fetchAll();
	 foreach($rows as $row){

?>
	<div class="py-1 top">
		<div class="container">
			<div class="row">
				<div class="col-sm text-center text-md-left mb-md-0 mb-2 pr-md-4 d-flex topper align-items-center">
					<p class="mb-0 w-100">
						<span class="fa fa-paper-plane"></span>
						<span class="text"><a href="mailto:<?php echo $row['Email']?>">
							<?php echo $row['Email']?></a></span>
					</p>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-7 d-flex topper align-items-center justify-content-end">
                    <a href="index-ar.php" style=" color: white; margin-left:200px">
                        <img src="images/ar.png " style="width:20px;max-width:20%"> ???????????????? 
 <?php 
			if (isset($_SESSION['user'])) {?>
			<ul class="nav navbar-nav navbar-right" style="margin-right:15px">
				<li class="dropdown open">
					<a class="dropdown-toggle" href="#" id="menu" role="button" data-toggle="dropdown" 
					aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-user" style="font-size:16px;color:#fc5e28"></i>
					<span><?php echo $_SESSION['user']?></span> <span class="caret"></span> 
					</a>

					<ul class="dropdown-menu" style="background-color:#040e26;margin-top:11px">
						<li>
							<a class="dropdown-item" style="color:#FFF;margin-bottom: 10px;"
							href="profile.php">
						<i class="fa fa-edit" style="font-size:16px;color:#fc5e28"></i> My Profile</a></li>
						<li><a class="dropdown-item" href="Logout.php" style="color:#FFF">
						<i class="fa fa-unlock-alt" style="font-size:16px;color:#fc5e28"></i> Logout</a></li>
					</ul>
			
			</li>
      </ul>
	  			<p class="mb-0 register-link"><a href="#" class="btn btn-primary" data-toggle="modal" 
					data-target="#exampleModalCenter">Inquire</a></p>
		<?php	
			}else{?>
				<a href="Login.php" class="Log" style="margin-right:50px;;margin-left:75px">
					<span>Login/Signup</span>
					</a>
					<p class="mb-0 register-link"><a href="Login.php" class="btn btn-primary">Inquire</a></p>
		<?php } ?>
					
	

					
				</div>
			</div>
		</div>
	</div>
	<div class="pt-4 pb-5">
		<div class="container">
			<div class="row d-flex align-items-start align-items-center px-3 px-md-0">
				<div class="col-md-4 d-flex mb-2 mb-md-0">
					<a class="navbar-brand d-flex align-items-center" href="index.php">
						<img loading="lazy" src="images/11.png" alt="Constra" style="width: 100px; height: 85px;">
						<span class="ml-2">Power Pack</span>
					</a>
				</div>
				<div class="col-md-4 d-flex topper mb-md-0 mb-2 align-items-center">
					<div class="icon d-flex justify-content-center align-items-center">
						<span class="fa fa-map"></span>
					</div>
					<div class="pr-md-4 pl-md-3 pl-3 text">
						<p class="con" ><span style="color: black;">Free Call</span> 
						<a href="tel: +2<?php echo $row['Telephone1'] ?>"  style="color: black;">
						+2<?php echo $row['Telephone1'] ?> </a></p>
						<p class="hr"><span>Call Us Now 24/7 Customer Support</span></p>
					</div>
				</div>
				<div class="col-md-4 d-flex topper mb-md-0 align-items-center">
					<div class="icon d-flex justify-content-center align-items-center"><span class="fa fa-paper-plane"></span>
					</div>
					<div class="text pl-3 pl-md-3">
						<p class="hr"><span>Our Location</span></p>
						<p class="hr"><span><?php echo $row['LocationEn']?></span></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container d-flex align-items-center">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fa fa-bars"></span> Menu
			</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>

                    <li class="nav-item dropdown-st">
					   <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              About Us
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="vision$mission.php">Vision And Mission</a>
                              <a class="dropdown-item" href="machines.php">Machines</a>
                              <a class="dropdown-item" href="qualitycontrol.php">Quality Control</a>
						</div>
					  </div> 
					</li>
    

                    <li class="nav-item dropdown-st">
					   <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              servicies
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="factory.php">Factory</a>
                              <a class="dropdown-item" href="applications.php">Applications</a>
						</div>
					  </div> 
					</li>



                    <li class="nav-item dropdown-st">
					   <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Products
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="products.php">Product Field</a>
                              <a class="dropdown-item" href="materials.php">Materials</a>
                              <a class="dropdown-item" href="advantages.php">Advantages</a>
						</div>
					  </div> 
					</li>



                    <li class="nav-item"><a href="iso.php" class="nav-link">ISO Certificates</a></li>
					<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
				</ul>
				<?php 
			if (isset($_SESSION['user'])) {
				?>
				<a href="#" class="btn-custom" data-toggle="modal" data-target="#exampleModalCenter">Inquire Now</a>
			<?php 
			}else {?>
				<a href="Login.php" class="btn-custom">Inquire Now</a>

	<?php		}?>
			</div>
		</div>
	</nav>
	<!-- END nav -->
			<?php }} ?>