<?php
/*
	================================================
	== Mange Members Page
	== You Can Add | Edit | Delete Members From Here
	================================================
	*/
	session_start();
	$pageTitle = 'User Menu';
	if (isset($_SESSION['Username'])) {
        include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
			// Start Manage Page 
	if($do == 'Manage') { # Manage Members Page
				// Select All Users Except Admin
				$stmt = $con->prepare("SELECT * FROM users ");
				$stmt->execute();  # Execute The Statement 
				// Assign To Variable
				$rows = $stmt->fetchAll();
			?>
				<h1 class="text-center" style="margin-top: 20px">Manage Users</h1>
				<div class="container">
					<div class="table-responsive">
						<table class="main-table text-center table table-bordered">
							<tr>
								<td>#ID</td>
								<td>Username</td>
								<td>Email</td>
								<td>Phone</td>
								<td>Address</td>
								<td>Control</td>
							</tr>
							<?php 
							foreach ($rows as $row) {
								echo "<tr>";
									if($_SESSION['ID'] != $row['UserID']){
										echo "<td>" . $row['UserID']."</td>";
										echo "<td>" . $row['Username']."</td>";
										echo "<td>" . $row['Email']."</td>";
										echo "<td>" . $row['Phone']."</td>";
										echo "<td>" . $row['Address']."</td>";
									if($row['GroupID'] == 1){
										echo "<td>
										<a href='profile.php?do=Edit&userid=" . $row['UserID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
										<a href='user-menu.php?do=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>
									</td>";
								}
								if($row['GroupID'] == 0){
									echo "<td>Just User</td>";
								}
									}
									
							echo "</tr>";
									}

							?>
									

						</table>
					</div>
					<a href="user-menu.php?do=Add" class="btn btn-primary" style="margin-bottom: 35px"><i class="fa fa-plus"></i>  New Member</a>
				</div>
				

		<?php 
	}elseif ($do == 'Add') {?>
			<h1 class="text-center" style="margin-top: 20px;">Add Member</h1>

					<div class="container">
					<a href="user-menu.php?do=Manage" class="btn btn-primary" 
            style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
            <i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i>  </a>
						<form class="form-horizontal" action="?do=Insert" method="POST">
							<!-- Start Username Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 control-label">Username</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="Username" class="form-control" 
									autocomplete="off" required = "required" placeholder="Username To Login Into Shop"/>
								</div>
							</div>
							<!-- End Username Field -->
							<!-- Start Password Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10 col-md-6">
									<input type="password" name="password" class="password form-control" 
									autocomplete="password" required = "required" placeholder="Password Must Be Hard & Complex" />
									<i class="show-pass fa fa-eye fa-2x"></i>
								</div>
							</div>
							<!-- End Password Field -->
							<!-- Start Email Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10 col-md-6">
									<input type="email" name="email" class="form-control" required = "required" 
									placeholder="Email Must Be Valid"/>
								</div>
							</div>
							<!-- End Email Field -->
							<!-- Start Fullname Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 control-label">Phone</label>
								<div class="col-sm-10 col-md-6">
									<input type="phone" name="phone" class="form-control" 
									required = "required" placeholder="Your Phone Number"/>
								</div>
							</div>
							<!-- End Username Field -->
							
							<!-- Start Submit Field -->
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<input type="submit" value="Add Member" class="btn btn-primary btn-lg"/>
								</div>
							</div>
							<!-- End Submit Field -->
						</form>
					</div>
				
	<?php	
		}elseif ($do == 'Delete') { # Delete Member Page ...
			echo "<h1 class='text-center'>Delete Member</h1>";
			echo "<div class='container'>";
				// Check If Get Request userid Is Numeric & Get The Integer Value Of It 
				$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']): 0;
				// Select All Data Depend on this ID
				$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
				// Execute Query
				$stmt->execute(array($userid));
				// Fetch The Data
				$row = $stmt->fetch();
				// The Row Count
				$count = $stmt->rowCount();
			// If There's Such ID Show The Form
			if($stmt->rowCount() > 0){
				$stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
				$stmt->bindParam(":zuser" , $userid);
				$stmt->execute();
			echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted';

			}else{
				echo "Good This Id Is Not Exist";
			}
		
	echo "</div>";
}elseif ($do == 'Insert') {
		# Insert Member Page ...
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					echo "<h1 class='text-center'>Insert Member</h1>";
					echo "<div class='container'>";
				// Get Variables From The Form
					$user   = $_POST['Username'];
					$pass   = $_POST['password'];
					$email 	= $_POST['email'];
					$phone 	= $_POST['phone'];
					$hashPass = sha1($_POST['password']);
					$GroupID = $_POST['GroupID'] = 1 ;
					// Validate The Form

					$formErrors = array();
					if(strlen($user) < 4){
						$formErrors[] ='Username Can\'t Be Less Than <strong>4 Characters</strong>';
					}
					if(strlen($user) > 20){
					$formErrors[] ='Username Can\'t Be More Than <strong>20 Characters</strong>';
					}
					if(empty($user)){
						$formErrors[] = 'Username Can\'t Be<strong>Empty</strong>';
					}
					if(empty($pass)){
						$formErrors[] = 'Password Can\'t Be<strong>Empty</strong>';
					}
					if(empty($email)){
						$formErrors[] = 'Email Can\'t Be <strong>Empty</strong>';
					}
					if(empty($GroupID)){
						$formErrors[] = 'Type Of user Can\'t Be <strong>Empty</strong>';
					}
					// Loop Into Errors Array And Echo It
					foreach ($formErrors as $error) {
						echo '<div class="alert alert-danger">' . $error . '</div>' ;
						# code...
					}

				// Check If There's No Error Proceed The Updata Operation 
					if(empty($formErrors)){
						$check = checkIteme("Username","users",$user);
						if($check == 0){
							$stmt = $con->prepare("INSERT INTO 
							users(Username,Password,Email,Phone,GroupID)
							VALUES(:zuser,:zpass,:zmail,:zphone,:zgroid)");
							$stmt->execute(array(
								'zuser' => $user,
								'zpass' => $hashPass,
								'zmail' => $email,
								'zphone' => $phone,
								'zgroid'=> $GroupID
							));
						
							// Echo Success Message 

							$successMesg  = $stmt->rowCount() . ' Record Inserted';
							$urlHome = 'user-menu.php';
							redirectBack($successMesg,$urlHome,3);
						}else{
							$errorMsg = 'Sorry, Write Another Username';
						    $urlPage = 'user-menu.php';
							redirectHome($errorMsg,$urlPage, 3);
							}
}
						}	
				}else{
					$errorMsg = 'Sorry You Can\'t Browse This Page Directly';
					$urlPage = 'user-menu.php';
					redirectHome($errorMsg,$urlPage , 3);

				}
				echo "</div>";

	include $tpl . 'footer.php';
}else {

	header('Location: index.php');
	exit();
}
