<?php
/*
	================================================
	== Mange Members Page
	== You Can Add | Edit | Delete Members From Here
	================================================
	*/
	session_start();
	$pageTitle = 'Orders List';
    if (isset($_SESSION['Username'])) {
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
        // Start Manage Page
    if ($do == 'Manage') { # Manage Members Page
                // Select All Users Except Admin
                $stmt = $con->prepare("SELECT requseteden.RequestID,requseteden.UserID, requseteden.ProductID,
				requseteden.Message, users.Username , users.Email, users.Phone , users.Address, productsen.ProductNameEn,
				productsen.ProductNameAr,productsen.imagePath FROM requseteden , users ,productsen WHERE requseteden.UserID = users.UserID AND 
				productsen.ProductID = requseteden.ProductID");
        $stmt->execute();  # Execute The Statement
        // Assign To Variable
        $rows = $stmt->fetchAll(); ?>
				<h1 class="text-center" style="margin-top: 20px">Orders List</h1>
				<div class="container">
					<div class="table-responsive">
						<table class="main-table manage-product text-center table table-bordered">
							<tr>
                                <td>#ID</td>
                                <td>Product Name En</td>
								<td>Product Name Ar</td>
								<td>Image</td>
								<td>Username</td>
								<td>Email</td>
								<td>Phone</td>
								<td>Address</td>
                                <td>Message</td>
								<td>Confirm Order</td>
							</tr>
							<?php
                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['RequestID']."</td>";
                                echo "<td>" . $row['ProductNameEn']."</td>";
                                echo "<td>" . $row['ProductNameAr']."</td>";
                                echo "<td><img src='Uploades/Products/" . $row['imagePath']. "' alt='' /></td>";
                                echo "<td>" . $row['Username']."</td>";
                                echo "<td>" . $row['Email']."</td>";
                                echo "<td>" . $row['Phone']."</td>";
                                echo "<td>" . $row['Address']."</td>";
                                echo "<td>" . $row['Message']."</td>";
                                echo "<td>
								<a href='orders.php?do=Edit&requestid=" . $row['RequestID'] . "' class='btn btn-primary'  style='margin-top:15px'>
								<i class='glyphicon glyphicon-ok'></i> Confirm</a>
								</td>";
                            } ?>	

						</table>
					</div>
				</div>
				

		<?php
    } elseif ($do == 'Edit') {
        $requestid = isset($_GET['requestid']) && is_numeric($_GET['requestid']) ? intval($_GET['requestid']) : 0;
        
        $stmt = $con->prepare("SELECT * ,productsen.ProductNameEn,productsen.imagePath FROM requseteden ,productsen  WHERE 
		requseteden.ProductID = productsen.ProductID AND RequestID = ? ");
        $stmt->execute(array($requestid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    
        if ($count > 0) {
            ?>

		<h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
    		Confirm Order</h1>
    	<div class="container">

			<a href="orders.php?do=Manage" class="btn btn-primary" 
				style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
				<i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i></a>

			<form class="form-horizontal" action="?do=Update" method="POST">

				<input type="hidden" name="requestid" value="<?php echo $requestid?>">

				<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label">Product Name</label>

                <div class="col-sm-10 col-md-6 col-md-lg">
                    <input style="max-height: 200px" type="text" class="form-control"
                    value="<?php echo $row['ProductNameEn']?>" readonly>
                </div>
				</div>

				<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label">Confirm Message</label>
				<div class="col-sm-10 col-md-6">
					<input style="height: 180px" type="text" name="message" class="form-control" 
					value="<?php echo $row['ConfirmOrder'] ?>"  placeholder="Confirm This Order"/>
				</div> 
				</div>
				
				<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" value="Save" class="btn btn-primary btn-lg"/>
				</div> 
				</div>
			</form>
    </div>
	<?php
    }    } elseif ($do == 'Update') { ?>
        <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
        Update Response</h1>
        <div class="container">
<?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(empty($_POST['message'])){
                $error = 'Please, Write Your Response For This Request';
            }
            if(empty($error)){
              $msg = $_POST['message'];
              $requestid = $_POST['requestid'];

              $stmt = $con->prepare("UPDATE requseteden SET ConfirmOrder = ? WHERE RequestID = ?");
              $stmt->execute(array($msg,$requestid));
              $successMesg  = $stmt->rowCount() . ' Record Update';
              $urlHome = 'orders.php';
              redirectBack($successMesg,$urlHome,3);
            }else{
                echo $error;
            }
            
            
        }
      }
   
         include $tpl . 'footer.php';
    } else {
        header('Location: index.php');
        exit();
    }
   
    