<?php
	session_start();
	include 'init.php';
	include 'Includes/header-ar.php';
	$stat = $con->prepare("SELECT * FROM themes WHERE GroupId = 1 LIMIT 4");
	$stat->execute();
	$rows = $stat->fetchAll();
	
?>
<div class="container">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
		  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
		</ol>
		<div class="carousel-inner">
		<?php foreach ($rows as $index => $row){
			if($index == 0){
			?>
		  <div class="carousel-item active">
			<img src="../Admin/Uploades/Themes/<?php echo $row['imagePath']?>" class="d-block w-100" alt="..." height="500"> 
		  </div>
		<?php
			}else{
		?>
		  <div class="carousel-item">
			<img src="../Admin/Uploades/Themes/<?php echo $row['imagePath']?>" class="d-block w-100" alt="..." height="500">
		  </div>
		 
		  <?php } } ?>
		</div>

		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		  <span class="sr-only">Previous</span>
		</a>

		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		  <span class="carousel-control-next-icon" aria-hidden="true"></span>
		  <span class="sr-only">Next</span>
		</a>
	  </div>
	</div>




	<section class="ftco-section" id="about-section" style="margin-top: 5%;">
		<div class="container">
			<div class="row">
				<div class="col-md-6 d-flex align-items-stretch">
					<div class="about-wrap img w-100" style="background-image: url(images/66.jpeg);">
					</div>
				</div>
				<div class="col-md-6 py-5 pl-md-5">
					<div class="row justify-content-center mb-4 pt-md-4">
						<div class="col-md-12 heading-section ftco-animate">
							<span class="subheading"style="text-align: right; ">مرحبا بكم في  </span>
							<h2 class="mb-4"style="text-align: right; ">باور باك</h2>
							<div class="d-flex about">
								<div class="icon"></div>
								<h3 style="text-align: right; font-size: 1.2em; font-weight: bold; ">تعتبر شركة باور باك من الشركات الرائدة فى مصر والشرق الاوسط فى تصنيع الشنط المنسوجة والغير منسوجة بجميع اشكالها واحجامها وقد تاسست الشركة سنة 2010 . واستطاعت الشركة في خلال هذه الفترة البسيطه ان تكتسب السوق المصرية بمنتجاتها كما انها تمكنت من اختراق اسواق التصدير.
                                </h3>
							</div>
							<h3 style="text-align: right; font-size: 1.2em; font-weight: bold; ">وتتميز شركتنا بالجودة العالية والقدرة على تلبية احتياجات العميل من الشنط والتنوع فى التصميمات للشنط مما يجعلها اداة جذب للعميل النهائي</h3>
							<h3 style="text-align: right; font-size: 1.2em; font-weight: bold; ">نجحت باور باك اليوم في اختراق العديد من الأسواق الخارجية وأصبحت واحدة من أفضل الشركات المصنعة للأقمشة المنسوجة وغير المنسوجة وأكثرها احترامًا في المنطقة ؛ وقد تم تحقيق ذلك كله من خلال نظام إدارتها الفعال وتسلسلها الهرمي عالي التنظيم وموظفيها.</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>





	<?php
	include 'Includes/footer-ar.php';
?>