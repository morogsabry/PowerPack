<?php
	session_start();
	include 'init.php';
	include 'Includes/header.php';

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
					<div class="about-wrap img w-100" style="background-image: url(images/iso.jpg);float: right;">
					</div>
				</div>
				<div class="col-md-6 py-5 pl-md-5" style="padding-top: 3rem !important">
					<div class="row justify-content-center mb-4 pt-md-4">
						<div class="col-md-12 heading-section ftco-animate">
							<span class="subheading">Welcome to Power Pack</span>
							<h2 class="mb-4">Power Pack Quality Control</h2>
							<div class="d-flex about">
								<h3>Our continuous striving for the latest technologies, the enhancement of technical processes and the application of new advanced materials, allow our company to provide customers with flexible packaging that is both competitive and advanced.  We apply the highest standards of quality measures and control, starting from using the finest types of raw materials up to testing the final products using our up-to-date machinery</h3>
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
	include 'Includes/footer.php';
?>




























