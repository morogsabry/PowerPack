<?php
	session_start();
	include 'init.php';
	include 'Includes/header-ar.php';
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
					<span class="subheading" style="font-size: 25px; display: block; margin-bottom: 5px; text-transform: uppercase; color: #fc5e28; font-weight: 600; margin-top: 5%;">تواصل معنا</span>
					<h2 class="mb-4" style="    line-height: 1.2; font-size: 30px; font-weight: 700;">راسلنا لمزيد من التفاصيل</h2>
					<p style="font-size: 20px; color: black;">المصنع</p>
					<p style="font-size: 20px; color: black;">
						
                                    مصنع المجموعة 118 - جنوب بورسعيد - قطعة رقم 49
                                    بورسعيد، مصر
                   </p>
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
								<p style="color: #fc5e28;"><span>المكتب الرئيسي </span> 
								<?php echo $row['LocationAr']?></p>
							</div>
						</div>
						<div class="dbox w-100 d-flex ftco-animate">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="fa fa-phone"></span>
							</div>
							<div class="text">
								<p><span>رقم الهاتف</span> 
								<a href="tel:+2<?php echo $row['Telephone1'] ?> ">+2<?php echo $row['Telephone1'] ?></a><br>
								<a href="tel:+2<?php echo $row['Telephone2'] ?> ">+2<?php echo $row['Telephone2'] ?></p>
							</div>
						</div>
						<div class="dbox w-100 d-flex ftco-animate">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="fa fa-paper-plane"></span>
							</div>
							<div class="text">
								<p><span>البريد الالكتروني</span> <a href="mailto:<?php echo $row['Email']?>">
								<?php echo $row['Email']?></a></p>
							</div>
						</div>
						<div class="dbox w-100 d-flex ftco-animate">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="fa fa-globe"></span>
							</div>
							<div class="text">
								<p><span>Website</span> <a href="http://powerpackegypt.com/index-ar.php">http://powerpackegypt.com</a></p>
							</div>
						</div>
					</div>
				</div>
<?php
if(!isset($_SESSION['user'])){
?>
	<div  style="margin-left:300px">إذا كان لديك أى أستفسار ، يرجى التواصل معنا من هنا 
	<i class='fa fa-hand-point-right' style='font-size:22px;color:#040e26'>&#xf0a4;</i>
	<button class="btn btn-primary" style="margin-left:5px">
		<a href="Login.php" style="color: #040e26;">تواصل معنــا</a>
	</button>
  </div><?php
}else{
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($sessionUser));
	$info = $getUser->fetch();
if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$error 		= '';
	$subject 	= $_POST['subject'];
	$message 	= $_POST['message'];

		// Check For Subject
		if(empty($subject)){
			$error .= '<p><label class="text-danger">Subject Is Required</label></p>';
			}else{
			$filterSub = filter_var($subject, FILTER_SANITIZE_STRING);
			$subject = $filterSub;
			}

		// Check For Message
		if(empty($message)){
			$error .= '<p><label class="text-danger">Message Is Required</label></p>';
			}else{
			$filterMsgs = filter_var($message, FILTER_SANITIZE_STRING);
			$msg = $filterMsgs;
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
		<form  method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="p-4 p-md-5 contact-form">
		<input type="hidden" name="userid" value="<?php echo $info['UserID'] ?>">	
		<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="الاسم"
						value="<?php echo $info['Username'] ?>" name="name">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="البريد الالكتروني"
						value="<?php echo $info['Email'] ?>" name="email">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<input type="text" name="subject" class="form-control" placeholder="الموضوع">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<textarea name="message" id="" cols="30" rows="7" class="form-control" 
						placeholder="الرساله"></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<input type="submit" value="ارسل الرساله" class="btn btn-primary py-3 px-5">
					</div>
				</div>
			</div>
		</form>
		
	</div>
<?php

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
	 }}
	include 'Includes/footer-ar.php';
?>