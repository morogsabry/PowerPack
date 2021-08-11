<?php
    session_start();
    if (isset($_SESSION['user'])){
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        if($do == 'Manage'){
        }elseif($do == 'Edit'){
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
            $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1 ");
            $stmt->execute(array($userid));
            $row = $stmt->fetch();  
            $count = $stmt->rowCount(); 
        
        // If Count > 0 This is Main The Database Contain Record About This Username 
        if ($stmt-> rowCount() > 0){
    
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
	<title>Power Pack</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon
      ================================================== -->
  <link rel="icon" type="image/png" href="images/11.png">

	
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="../Admin/Layout/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">
	
	<link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/myedit.css">
    
</head>
<body>
 <h1 class="text-center" style=" font-size: 50px; margin: 40px 0px; font-weight: bold;">
 Edit Profile</h1>
    <div class="container">

        <form class="form-horizontal" action="?do=Update" method="POST" style="margin-left: 200px;">
            <input type="hidden" name="userid" value="<?php echo $userid ?>">
            <div class="form-group form-group-lg" style="margin-right: -15px;margin-left: -15px;
                margin-bottom: 15px;">
               <label class="col-sm-2 control-label" style="padding-top: 14.33px;font-size: 18px;
               color:#040e26">Username</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="username" class="form-control" value="<?php echo $row['Username'] ?>" 
                   autocomplete="off" required="required" placeholder="Username To Login" style="height: 46px;
    padding: 10px 16px; font-size: 18px;line-height: 1.3333333; border-radius: 6px;"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Password</label>
               <div class="col-sm-10 col-md-6">
                   <input type="hidden" name="oldpassword" value="<?php echo $row['Password']?>"/>
                   <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Password Must Be Hard & Complex"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Email</label>
               <div class="col-sm-10 col-md-6">
                   <input type="email" name="email" class="form-control" value="<?php echo $row['Email'] ?>" required="required" placeholder="Email Must Be Valid"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Phone</label>
               <div class="col-sm-10 col-md-6">
                   <input type="phone" name="phone" class="form-control" value="<?php echo $row['Phone'] ?>" placeholder="Phone Must Be Right "/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Address</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="address" class="form-control" value="<?php echo $row['Address'] ?>" placeholder="Address Must Be Right "/>
               </div> 
            </div>

            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                   <input type="submit" value="Save" class="btn btn-primary btn-lg"/>
               </div> 
            </div>
        </form>
    </div>
      <?php  }else{
          echo 'No Such ID';
      } }elseif($do == 'Update'){ ?>
          <h1 class="text-center" style=" font-size: 50px; margin: 40px 0px; font-weight: bold;">Update Profile</h1>
        <div class="container">
<?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $id = $_POST['userid'];
            $user = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $pass = '';

            if(empty($_POST['newpassword'])){
                $pass = $_POST['oldpassword'];
            }else{
                $pass = sha1($_POST['newpassword']);
            }

            $fromErrors = array();
            if(empty($user)){
                $fromErrors[] = '<div class="alert alert-danger">User Can\'t Be Empty</div>';
            }
            if(empty($email)){
                $fromErrors[] = '<div class="alert alert-danger">Email Can\'t Be Empty</div> ';
            }

            foreach($fromErrors as $error){
                echo $error . '<br/>';
            }
           if(empty($fromErrors)){
            $stmt = $con->prepare("UPDATE users SET Username = ?, Password = ? ,Email = ?, Phone = ?, Address = ? WHERE UserID = ?");
            $stmt->execute(array($user,$pass,$email,$phone,$address,$id));

            $successMesg  = $stmt->rowCount() . ' Record Update';
            $urlHome = 'profile.php';
            $seconds = 3;
            echo "<div class='alert alert-success'>$successMesg</div>";
            echo "<div class='alert alert-info'>You Will Be Redirected to Homepage After $seconds Seconds.</div>";
            header("refresh: $seconds; url=$urlHome");
            exit();
           }
          }    
?>

<script src="js/jquery.min.js"></script>
		<script src="js/jquery-migrate-3.0.1.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/jquery.waypoints.min.js"></script>
		<script src="js/jquery.stellar.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/jquery.magnific-popup.min.js"></script>
		<script src="js/jquery.animateNumber.min.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script src="js/jquery.timepicker.min.js"></script>
		<script src="js/scrollax.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
		<script src="js/google-map.js"></script>

		
		<script src="js/main.js"></script>
        <script src="js/front.js"></script>
		
	

<?php
      }
}else {
    header('Location: index.php');
    exit();
}?>
</body>
	</html>