<?php
	session_start();
	include 'init.php';
	include 'Includes/header.php';

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
							<span class="subheading">Welcome to Power Pack</span>
							<h2 class="mb-4">Power Pack Advantages</h2>
							<div class="d-flex about">
								<h3>The variety of materials used, which gives the customer easy access to the best tastes</h3>
                            </div>
                            <ul style="letter-spacing:0; font-size: 20px; font-weight: 500; color: black;">
                                <li>
                                   Maintains and indicates freshness.
                                </li>
                                <li>
                                    Made from high-grade materials. Approved food grade materials that are contaminant free and perfectly safe.
                                </li>
                                <li>
                                    Lightweight and easy to open, carry and store.    
                                </li>
                                <li>
                                    Extends the shelf life of many products, especially food, and has a positive. Sustainability profile.
                                </li>
                                <li>
                                   Offers consumer conveniences
                                </li>
                                <li>
                                    Widely extendible into diverse product categories.
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