<?php
	session_start();
	include 'init.php';
	include 'Includes/header-ar.php';
?>


	<div class="container">
	<section>
	<center>
			<?php
				$stat = $con->prepare("SELECT * FROM imagesofpages WHERE GroupId = 'advantages'  LIMIT 1");
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


	<section class="ftco-section" id="about-section" style="margin-top: 5%;" >
		<div class="container">
			<div class="row">
                <div class="col-md-6 d-flex align-items-stretch">
					<div class="about-wrap img w-100" style="background-image: url(images/66.jpeg);">
					</div>
				</div>
                <div class="col-md-6 py-5 pl-md-5">
					<div class="row justify-content-center mb-4 pt-md-4">
						<div class="col-md-12 heading-section ftco-animate">
							<span class="subheading"style="text-align: right;">مرحبا بك في باور باك</span>
							<h2 class="mb-4"style="text-align: right;">مميزات باور باك</h2>
							<div class="d-flex about"style="text-align: right;">
								<h3 style="text-align: right;">تنوع الخامات المستخدمة مما يعطي العميل سهولة الحصول علي احسن الاذواق</h3>
                            </div>
                            <ul style="text-align:right; list-style-type:none; font-size: 20px; font-weight: 500; color:black;">
                                <li style="text-decoration: none;">
                                  ١: المرونة الكاملة في تنفيذ التصميمات المطلوبة وتحقيق اعلي درجات الجودة في الطباعة مما يعطي للعميل الميزة التنافسية ويساعدة في تسويق منتجاته
                                </li>
                                <li>
                                    ٢: التصنيع من خامات عالية الجودة وامنة تماما العالمية
                                </li>
                                <li>
                                    ٣: خفيفة الوزن وسهلة الفتح والاستعمال    
                                </li>
                                <li>
                                     ٤: امنة ومتوافقة مع البيئة
                                </li>
                                <li>
                                   ٥: تمتاز بالمرونة وسهولة التعديل والإبتكار
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