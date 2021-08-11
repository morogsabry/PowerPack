<?php
	session_start();
	include 'init.php';
	include 'Includes/header-ar.php';
?>


	<div class="container">
	<section>
		<center>
			<?php
				$stat = $con->prepare("SELECT * FROM imagesofpages WHERE GroupId = 'qualitycontrol'  LIMIT 1");
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
		<div class="container">
			<div class="row">
                <div class="col-md-6 d-flex align-items-stretch">
					<div class="about-wrap img w-100" style="background-image: url(images/iso.webp);float: right;">
					</div>
				</div>
				<div class="col-md-6 py-5 pl-md-5" style="padding-top: 3rem !important">
					<div class="row justify-content-center mb-4 pt-md-4">
						<div class="col-md-12 heading-section ftco-animate">
							<span class="subheading"style="text-align: right; ">مرحبا بك في باور باك</span>
							<h2 class="mb-4"style="text-align: right; ">رقابه الجوده في باور باك</h2>
							<div class="d-flex about"style="text-align: right; ">
                              <h3>إيماناً منا بأن الجودة هي الأصل في العمل فنحن دائماً نواصل السعي للحصول على أحدث التكنولوجيا لتعزيز العمليات التقنية والإستفادة منها في التطبيق لمنظومة العمل مما يمنح عملاؤنا المزيد من القدرة التنافسية والتسويقية للإرتقاء بالمستوى العام لخدمة عملائهم. 
                                    نطبق اعلى معايير الجودة وتدابير المراقبة اعتبارا منا باستخدام اجود انواع المواد الخام الى اختبار المنتجات النهائية باستخدام احدث  الالات. 
                                    و من هذا المنطلق فقد حرصت شركتنا للحصول على شهادات الجودة </h3>
                            </div>
                            <ul>
                                <li>
                                    <p> ISO 9001/ 2019</p>
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