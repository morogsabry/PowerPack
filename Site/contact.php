<?php
	session_start();
	include 'init.php';
	include 'Includes/header.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		if($do == 'Manage'){
			
			$stmt2 = $con->prepare("SELECT * FROM contactus LIMIT 1");
			$stmt2->execute();  
			$rows = $stmt2->fetchAll();
			foreach($rows as $row){
		
			

?>


	<section class="ftco-section contact-section ftco-no-pb" id="contact-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading" style="font-size:24px; margin-top: 7%;">Contact us</span>
					<h2 class="mb-4" style="font-size: 22px;">Message us for more details</h2>
					<div style="font-size: 20px; color: black;">
					<p>Factroy</p>
					<p>
						Group 118 factory – south of port said – piece no.49
						Port said – Egypt
						</p>
					</div>	
				</div>
			</div>

			<div class="row block-9">

				<div class="col-md-4 d-flex pl-md-5">
					<div class="row">
						<div class="dbox w-100 d-flex ftco-animate">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="fa fa-map-marker"></span>
							</div>
							<div class="text">
								<p style="color: #fc5e28;"><span>Head office:</span>
								<?php echo $row['LocationEn']?> </p>
							</div>
						</div>
						<div class="dbox w-100 d-flex ftco-animate">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="fa fa-phone"></span>
							</div>
							<div class="text">
								<p><span>Phone:</span> 
								<a href="tel:+2<?php echo $row['Telephone1'] ?> ">+2<?php echo $row['Telephone1'] ?></a><br>
								<a href="tel:+2<?php echo $row['Telephone2'] ?> ">+2<?php echo $row['Telephone2'] ?>
							</p>
							</div>
						</div>
						<div class="dbox w-100 d-flex ftco-animate">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="fa fa-paper-plane"></span>
							</div>
							<div class="text">
								<p><span>Email:</span> <a href="mailto:<?php echo $row['Email']?>"><?php echo $row['Email']?></a></p>
							</div>
						</div>
						<div class="dbox w-100 d-flex ftco-animate">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="fa fa-globe"></span>
							</div>
							<div class="text">
								<p><span>Website</span> <a href="http://powerpackegypt.com/">http://powerpackegypt.com</a></p>
							</div>
						</div>
					</div>
				</div>
			
<?php 

if(!isset($_SESSION['user'])){
?>
	<div  style="margin-left:300px">If You Have Any Question , Contact us 
	<i class='fa fa-hand-point-right' style='font-size:22px;color:#040e26'>&#xf0a4;</i>
	<button class="btn btn-primary" style="margin-left:5px">
		<a href="Login.php" style="color: #040e26;">Question Us</a>
	</button>
  </div><?php
}else{
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($sessionUser));
	$info = $getUser->fetch();
if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$error 		= '';
	$name 		= $_POST['name'];
	$email 		= $_POST['email'];
	$subject 	= $_POST['subject'];
	$message 	= $_POST['message'];
		// Check For Name
		if(empty($_POST['name'])){
			$error .= '<p><label class="text-danger">Please, Enter Your Name</label></p>';
		}else{
			$filterName = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
			$name = $filterName;
		}

		// Check For Email
		if(empty($_POST['email'])){
			$error .= '<p><label class="text-danger">Please, Enter Your Email</label></p>';
		}else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error .= '<p><label class="text-danger">Invalid Email Format</label></p>';
			}
			
		}

		// Check For Subject
		if(empty($_POST['subject'])){
			$error .= '<p><label class="text-danger">Subject Is Required</label></p>';
			}else{
			$filterSub = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
			$subject = $filterSub;
			}

		// Check For Message
		if(empty($_POST['message'])){
			$error .= '<p><label class="text-danger">Message Is Required</label></p>';
			}else{
			$filterMsgs = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
			$message = $filterMsgs;
			}
			

	// Insert Data 
	$stmt = $con->prepare("INSERT INTO 
	quations(UserID , Subject , Message,DateQuestion )
	VALUES(:zuserid , :zsubject,:zmessage,now())");
	$stmt->execute(array(
		'zuserid'  => $info['UserID'],
		'zsubject' => $subject,
		'zmessage'  => $message
		
 ));
}
?>
	<div class="col-md-8">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="p-4 p-md-5 contact-form">
	<input type="hidden" name="userid" value="<?php echo $info['UserID'] ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<input name="name" type="text" class="form-control" placeholder="Your Name"
					value="<?php echo $info['Username'] ?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<input name="email" type="text" class="form-control" placeholder="Your Email"
					value="<?php echo $info['Email'] ?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<input name="subject" type="text" class="form-control" placeholder="Subject">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<textarea name="message" id="" cols="30" rows="7" class="form-control" 
					placeholder="Message"></textarea>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<input name="submit" type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
				</div>
			</div>
		</div>
	</form>
	</div>

<?php

	}

	// Form If You Can Login



 }
?>
			
<div style="position:relative;height:500px;width:1100px;">
	<div style="overflow:hidden;background:none!important;width:1100px;">
		<iframe width="1100" height="500" id="gmap_canvas"
			src="https://maps.google.com/maps?q=Qesm%20Awal%20Al%20Ganoub,%20Port%20Said%20Governorate&t=k&z=13&ie=UTF8&iwloc=&output=embed"
			frameborder="0" scrolling="no" marginheight="0" marginwidth="0">	
		</iframe>
		<a href="https://soap2day-to.com"></a>
		<a href="https://www.embedgooglemap.net"></a>
</div>
</div>
	</section>


	<?php
 
	include 'Includes/footer.php';
		}
?>