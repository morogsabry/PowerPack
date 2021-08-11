<?php
include 'init.php';
	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
	if($do == 'Manage'){
	 $stmt2 = $con->prepare("SELECT * FROM contactus ");
	 $stmt2->execute();  
	 $rows = $stmt2->fetchAll();
	 foreach($rows as $row){
?>
<footer class="ftco-footer">
		<div class="container mb-5 pb-4">
			<div class="row">
				<div class="col-lg col-md-6">
					<div class="ftco-footer-widget">
						<h2 class="ftco-heading-2 d-flex align-items-center">تعريف الشركه</h2>
							<ul class="list-unstyled mr-md-4">
								<li><a href="vision$mission-ar.php"><span class="fa fa-chevron-right mr-2"></span>الرؤيه و المهمه</a></li>
								<li><a href="machines-ar.php"><span class="fa fa-chevron-right mr-2"></span>الماكينات</a></li>
								<li><a href="qualitycontrol-ar.php"><span class="fa fa-chevron-right mr-2"></span>رقابه الجوده</a></li>
							</ul>
						<ul class="ftco-footer-social list-unstyled mt-4">
						<li><a href="<?php echo $row['twitter']?>"><span class="fa fa-twitter"></span></a></li>
							<li><a href="<?php echo $row['facebook']?>"><span class="fa fa-facebook"></span></a></li>
							<li><a href="<?php echo $row['instgram']?>"><span class="fa fa-instagram"></span></a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="ftco-footer-widget">
						<h2 class="ftco-heading-2">Links</h2>
						<div class="d-flex">
							<ul class="list-unstyled mr-md-4">
								<li><a href="index-ar.php"><span class="fa fa-chevron-right mr-2"></span>الصفحه الرئيسيه</a></li>
								<li><a href="factory-ar.php"><span class="fa fa-chevron-right mr-2"></span>خدمات المصنع</a></li>
								<li><a href="applications-ar.php"><span class="fa fa-chevron-right mr-2"></span>التطبيقات</a></li>
								<li><a href="iso-ar.php"><span class="fa fa-chevron-right mr-2"></span>الشهادات الممنوحه</a></li>
							</ul>
							<ul class="list-unstyled mr-md-4">
								<li><a href="products-ar.php"><span class="fa fa-chevron-right mr-2"></span>مجالات الاستخدام</a></li>
								<li><a href="materials-ar.php"><span class="fa fa-chevron-right mr-2"></span>الخامات</a></li>
								<li><a href="advantages-ar.php"><span class="fa fa-chevron-right mr-2"></span>المميزات</a></li>
								<li><a href="contact-ar.php"><span class="fa fa-chevron-right mr-2"></span>تواصل معنا</a></li>
							</ul>
						</div>
					</div>
				</div>


				<div class="col-lg col-md-6">
					<div class="ftco-footer-widget">
						<h2 class="ftco-heading-2">لديك أسئلة؟</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="fa fa-map-marker mr-3"></span><span class="text">
								<?php echo $row['LocationAr']?></span></li>
									<li>
								    <a href="tel: +2<?php echo $row['Telephone1'] ?>">
								    <span class="fa fa-phone mr-3"></span>
								    <span class="text"><?php echo $row['Telephone1'] ?></p></span></a>
								</li> 
							<li><a href="mailto:<?php echo $row['Email']?>"><span class="fa fa-paper-plane mr-3">
								</span><span class="text"><?php echo $row['Email']?></span></a></li> 
							</ul>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid bg-primary">
			<div class="container">
				<div class="row">
					<div class="col-md-6 aside-stretch py-3">
						
						<p class="mb-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights is made <i class="fa fa-heart" aria-hidden="true"></i> by 
							<a href="http://motigraph.com" target="_blank">Motigraph</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<?php 
		if (isset($_SESSION['user'])){
			// Call Data From Product Table
			$getProduct = $con->prepare("SELECT productsen.ProductID ,productsen.ProductNameAr FROM productsen");
			 $getProduct->execute();
			 $products = $getProduct->fetchAll();
			// Call Data From Users Table
			$getUser = $con->prepare("SELECT users.UserID , users.Username , users.Phone
			FROM users WHERE Username = ?");
			$getUser->execute(array($sessionUser));
			$info = $getUser->fetch();

			
			// Insert Data
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Set Variables 
				$userid = $info['UserID'];
				$product = $_POST['productid'];
				$message = $_POST['message'];
				if(empty($_POST['message'])){
					$error = 'You Must Write The Description of Your Order ';
				}
				if(empty($error)){
					$stmt = $con->prepare("INSERT INTO 
					requseteden(UserID ,ProductID , Message, DateOrder )
					VALUES(:zuserid , :zproductid,:zmessage,now())");
					$stmt->execute(array(
						'zuserid'  => $userid,
						'zproductid' => $product,
						'zmessage'  => $message
					));
				}	}
		?>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close d-flex align-items-center justify-content-center" 
			data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="fa fa-close"></span>
			</button>
		</div>
		<div class="modal-body p-4 p-md-5">
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="appointment-form ftco-animate">
			<input type="hidden" name="userid" value="<?php echo $info['UserID'] ?>">
				<h3>Request Quote</h3>

				<div class="">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="أسم المستخدم"
						value="<?php echo $info['Username'] ?>">
					</div>
				
					<div class="form-group">
						<input type="text" class="form-control" placeholder="رقم الهاتف"
						value="<?php echo $info['Phone'] ?>">
					</div>
				</div>
				
					<div class="form-group">
						<div class="form-field">
							<div class="select-wrap">
								<div class="icon"><span class="fa fa-chevron-down"></span></div>
								<select name="productid" id="" class="form-control">
									<option>اختر المنتج</option><?php
								foreach($products as $product){?>
								<option value="<?php echo $product['ProductID'] ?>">
									<?php echo $product['ProductNameAr'] ?></option>
								<?php }?>
								</select>
							</div>
						</div>
					</div>
				
				<div class="">
					<div class="form-group">
						<textarea name="message" cols="30" rows="4" class="form-control" 
						placeholder="رساله مرفقه"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="اطلب المنتج" class="btn btn-primary py-3 px-4">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<?php }} }?>
		<!-- loader -->
		<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-migrate-3.0.1.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/jquery.waypoints.min.js"></script>
		<script src="js/jquery.stellar.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/jquery.magnific-popup.min.js"></script>
		<script src="js/jquery.animateNumber.min.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script src="js/jquery.timepicker.min.js"></script>
		<script src="js/scrollax.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
		<script src="js/google-map.js"></script>
		
		<script src="js/main.js"></script>
		
	</body>
	</html>