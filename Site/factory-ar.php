<?php
	session_start();
	include 'init.php';
	include 'Includes/header-ar.php';

?>


	<div class="container">
	<section>
	<center>
			<?php
				$stat = $con->prepare("SELECT * FROM imagesofpages WHERE GroupId = 'factory'  LIMIT 1");
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
				<center>
				<div class="col-md-6 py-5 pl-md-5" style="padding-top: 3rem !important">
					<div class="row justify-content-center mb-4 pt-md-4">
						<div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading">في باور باك</span>
								<h3 class="d-flex about" style="display: inline; text-align: right;"> تقدم شركتنا افضل الخدمات التصنيعية للعملاء مما يرتقي بمستوي جودة المنتج 
                                    بافضل الخامات العالمية واعلي معايير الجودة </h3>
							
					</div></center>
				</div>
			</div>
		</div>
	</section>
      <section>
        <div style="background-color: #fc5e28; margin-top: 0.5%; margin-bottom: 0.5%; margin-left: 0.5%; margin-right: 0.5%;  max-height: 5%">
            <img src="images/sewing.jpg" style="max-width: 50%; ">
            
            <h2 style="display: inline; text-align: center; margin-left: 5%; line-height:1.2; font-size: 40px; font-weight: 700; color:rgba(255, 255, 255, 0.7);" >شنط منسوجة مخيطة</h2>            
            
        </div>
        </section>
   	<section class="ftco-section ftco-no-pt ftco-no-pb ftco-counter">
		<div class="img image-overlay" style="background-image: url(images/sewing.jpg);"></div>
		<div class="container">
			<div class="row no-gutters">
				<div class="col-md-6 py-5 bg-secondary aside-stretch" style="padding-top: 3rem !important">
					<div class="heading-section heading-section-white p-4 pl-md-0 py-md-5 pr-md-5">
						
						<h2 class="mb-4">شنط غير منسوجة مخيطة</h2>
					</div>
				</div>
            </div>
			</div>
		</div>
	</section>

      <section>
        <div style="background-color: #fc5e28; margin-top: 0.5%; margin-bottom: 0.5%; margin-left: 0.5%; margin-right: 0.5%;  max-height: 5%">
            <img src="images/555.jpeg" style="max-width: 50%; ">
            
            <h2 style="display: inline; text-align: center ; line-height:1.2; font-size: 40px; font-weight: 700; color:rgba(255, 255, 255, 0.7);" >شنط غير منسوجة لحام الترا سونيك </h2>            
            
        </div>
        </section>


	<?php
	include 'Includes/footer-ar.php';
?>