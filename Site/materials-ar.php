<?php
	session_start();
	include 'init.php';
	include 'Includes/header-ar.php';
?>

	<div class="container">
	<section>
	<center>
			<?php
				$stat = $con->prepare("SELECT * FROM imagesofpages WHERE GroupId = 'materials'  LIMIT 1");
				$stat->execute();
				$rows = $stat->fetchAll();			
			
			?>
			<?php
				foreach($rows as $row){
			?>
			<img src="../Admin/Uploades/ImageOfPages/<?php echo $row['imagePath']?>" 
			style="width: 100%; height: 500px;" data-stellar-background-ratio="0.5;">
			<?php
				}
			?>
		</center>
	</section>
</div>






	<section class="ftco-section" id="about-section" >
		<div class="container" style="margin-top: 5%;">
			<div class="row">
                <div class="col-md-6 d-flex align-items-stretch">
					<div class="about-wrap img w-100" style="background-image: url(images/material.jpg);">
					</div>
				</div>
                <div class="col-md-6 py-5 pl-md-5">
					<div class="row justify-content-center mb-4 pt-md-4">
						<div class="col-md-12 heading-section ftco-animate">
							<span class="subheading"style="text-align: right; ">مرحبا بك في باور باك</span>
							<h2 class="mb-4"style="text-align: right; ">خامات باور باك</h2>
							<div class="d-flex about"style="text-align: right; ">
								<h3>تنوع الخامات المستخدمة مما يمنح العميل سهولة الوصول إلى أفضل الأذواق</h3>
                            </div>
                            <ul style="letter-spacing:0; font-size: 20px; font-weight: 500; color: black; text-align: right; list-style-type: none;">
                                <li>
                                   ١: بولي بروبيلين شفاف منسوج
                                </li>
                                <li>
                                   ٢: بولي بروبيلين ابيض منسوج
                                </li>
                                <li>
                                    ٣: بولي بروبيلين غير منسوج جميع الالوان
                                </li>

                            </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


<?php
	include 'Includes/footer-ar.php';
?>