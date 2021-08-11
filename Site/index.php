<?php
	session_start();
	include 'init.php';
	include 'Includes/header.php';

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
							<span class="subheading">Welcome to </span>
							<h2 class="mb-4">Power Pack</h2>
							<div class="d-flex about">
								<div class="icon"></span></div>
								<h3 style="font-size: 1.2em; font-weight: bold;">Power pack is one of the leading companies in Egypt and Middle East in the field of woven and nonwoven bags of all shape and size our company was incorporated in 2010.</h3>
							</div>
							<h3 style="font-size: 1.2em; font-weight: bold;">Our company is distinguished by its high quality and ability to meet the customer s needs of bags and the diversity of designs for bags, which makes it a tool of attraction for the end user.</h3>
							<h3 style="font-size: 1.2em; font-weight:bold;">Power pack today has succeeded in penetrating many foreign markets and became one of the top and most respected )woven &nonwoven ags) manufacturers in the region; This was all achieved by its efficient management system, its highly organized hierarchy and staff.</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>




<?php
	include 'Includes/footer.php';
?>