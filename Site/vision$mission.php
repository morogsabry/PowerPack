<?php
	session_start();
	include 'init.php';
	include 'Includes/header.php';

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
                            <span class="subheading" style="text-align: center;">In Power Pack</span>
								<h3 class="d-flex about" style="display: inline; text-align: center;">Our company purveys solution to packaging industries, purveying safe and high quality printing, manufacturing a variety of end product packaging materials</h3>
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
							<h3 class="heading mb-3">OUR MISSION</h3>
							<p>
								Our mission is to supply the regional and global markets with high quality durable products. In doing so, we stress on commitment and responsiveness towards our customers. We observe good corporate citizenship and we act as custodians of interests of both the owners and employees, while being socially and environmentally conscious.
							</p>
						</div>
					</div>      
				</div>
				<div class="col-lg-6 d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services services-2 d-flex">
						<div class="icon justify-content-center align-items-center d-flex"><span class="flaticon-worker-1"></span></div>
						<div class="media-body pl-4">
							<h3 class="heading mb-3">OUR VISION</h3>
							<p>To become Egypt’s leading company, and one of the top in the world for producing plastic bags form woven and non woven.
								</p>
						</div>
					</div>      
				</div>
			</div>
		</div>
	</section>







	<?php
	include 'Includes/footer.php';
?>