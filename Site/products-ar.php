<?php
	session_start();
	include 'init.php';
	include 'Includes/header-ar.php';
	$perPage = 6;
	$stmt = $con->query('SELECT count(*) FROM productsen');
    $total_results = $stmt->fetchColumn();
    $total_pages = ceil($total_results / $perPage);

    // Current page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $starting_limit = ($page - 1) * $perPage;

    // Query to fetch users
    $query = "SELECT * FROM productsen ORDER BY ProductID DESC LIMIT $starting_limit,$perPage";

    // Fetch all users for current page
    $products = $con->query($query)->fetchAll();
?>

	<div class="container">
	<section>
		<center>
			<?php
				$stat = $con->prepare("SELECT * FROM imagesofpages WHERE GroupId = 'products'  LIMIT 1");
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

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3" style="padding-top: 3rem !important">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">اخــــــر </span>
					<h2 class="mb-4">منتجــــاتنا</h2>
				</div>
			</div>

	<div class="row" style="text-align:right;">
	<?php foreach ($products as $key => $product): ?>
		<div class="col-md-4">
			<div class="project">
				<a href="../Admin/Uploades/Products/<?php echo $product['imagePath']?>" 
				class="img image-popup d-flex align-items-center" 
				style="background-image: url(../Admin/Uploades/Products/<?php echo $product['imagePath'];?>);">

					<div class="icon d-flex align-items-center justify-content-center mb-5">
						<span class="fa fa-plus"></span></div>
				</a>
				<div class="text">
					<span class="subheading">	وصف المنتج </span>
					<h3><?php echo $product['ProductNameAr']?><br>
					<?php echo $product['DescriptionAr']?></h3>
					<p><span class="fa fa-map-marker mr-1"></span> 
					<?php echo $product['LocationAr']?></p>
				</div>
			</div>
		</div>
		<?php endforeach; ?>		
	
				
	<!-- Start Count Raw -->
	<div class="row mt-5">
				<div class="col text-center">
					<div class="block-27">
						<ul>
							<li><a href="#">&lt;</a></li>

							<?php for ($page = 1; $page <= $total_pages ; $page++):?>
							<i class="active"><a href='<?php echo "?page=$page"; ?>'>
								<span style="color: #040e26;text-align: center;display: inline-block;
    					width: 40px;height: 40px;line-height: 40px;border-radius: 50%;border: 1px solid #cccccc;">	<?php  echo $page; ?></span>
								</a></i>	
							<?php endfor; ?>

							<li><a href="#">&gt;</a></li>
						</ul>
					</div>
				</div>
			</div>

		</div>
	</section>
	
	

	<?php
	include 'Includes/footer-ar.php';
?>