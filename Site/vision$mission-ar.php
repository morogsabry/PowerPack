<?php
	session_start();
	include 'init.php';
	include 'Includes/header-ar.php';
?>

	<div class="container">
	<section>
		<center>
			<?php
				$stat = $con->prepare("SELECT * FROM imagesofpages WHERE GroupId = 'vision\$mission'  LIMIT 1");
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


	<section class="ftco-section" id="about-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 py-5 pl-md-5" style="padding-top: 3rem !important">
					<div class="row justify-content-center mb-4 pt-md-4">
						<div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading"style="text-align: center; ">في باور باك</span>
								<h3 class="d-flex about" style="display: inline;"style="text-align: right; ">تقدم شركتنا حلاً لصناعات التغليف ، وتوفر طباعة آمنة وعالية الجودة ، وتصنيع مجموعة متنوعة من مواد تغليف المنتجات </h3>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="ftco-section ftco-no-pt ftco-no-pb ftco-services-2">
		<div class="container">
			<div class="row no-gutters d-flex">
				<div class="col-lg-6 d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services d-flex">
						<div class="icon justify-content-center align-items-center d-flex"><span class="flaticon-engineer-1"></span></div>
						<div class="media-body pl-4">
							<h3 class="heading mb-3"style="text-align: right; ">المهمه</h3>
							<p style="text-align: right; ">
                                مهمتنا تكمن في تزويد الاسواق المحلية والعالمية بمنتجاتنا عالية الجودة والمتانة
                                ونحن اذ نفعل ذلك انما نؤكد علي الالتزام والاستجابة ورعاية حقوق عملائنا في الحصول علي الحماية لمصالحهم وعلاماتهم التجارية وكامناء علي مصالح موظفينا صحيا واجتماعيا وان تكون منتجاتنا صديقة للبيئة
							</p>
						</div>
					</div>      
				</div>
				<div class="col-lg-6 d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services services-2 d-flex">
						<div class="icon justify-content-center align-items-center d-flex"><span class="flaticon-worker-1"></span></div>
						<div class="media-body pl-4">
							<h3 class="heading mb-3"style="text-align: right; ">الرؤية</h3>
							<p style="text-align: right; ">أن تصبح شركتنا الاولي في مجال انتاج وطباعة االشنط المنسوجة والغير منسوجة في مصر والشرق الاوسط ومن اكبر الشركات علي مستوي العالم
								</p>
						</div>
					</div>      
				</div>
			</div>
		</div>
	</section>


	<?php
	include 'Includes/footer-ar.php';
?>