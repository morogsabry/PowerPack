<?php
session_start();
if (isset($_SESSION['user'])){
    header('Location: index.php'); // Redirect To Home Page
}
    include 'init.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['login'])){
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $hashedPass = sha1($pass);
    
            // Check If The User Exist In Database
    
            $stmt = $con->prepare("SELECT  Username , Password 
                                    FROM users 
                                    WHERE Username = ? 
                                    AND Password = ? AND 
                                    GroupID = 0
                                    LIMIT 1 
                                    ");
            $stmt->execute(array($user,$hashedPass));
            $row = $stmt->fetch();  
            $count = $stmt->rowCount(); 
            
            // If Count > 0 This is Main The Database Contain Record About This Username 
            if ($count > 0){
                $_SESSION['user'] = $user; // Registar Session Name
                $_SESSION['ID'] = $row['UserID'];
                header('Location: profile.php'); // Redirect To Dashboard Page
                exit();
            }
        }else{
            $formErrors = array();
            $user = $_POST['user'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $email = $_POST['email'];

            if(isset($user)){
                $filterUser = filter_var($user, FILTER_SANITIZE_STRING);
                if(strlen($filterUser) < 4 ){
                    $formErrors[] = 'Username Must Be Latger Than 4 Characters';
                }
            }

            if(isset($pass1) && isset($pass2)){
                if(empty($pass1)){
                    $formErrors[] = 'Sorry Password Cant Be Empty';
                }

               if(sha1($pass1) !== sha1($pass2)){
                   $formErrors[] = 'Sorry Password Is Not Match';
               }
            }

            if(isset($email)){
                $filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
                if(filter_var($filterEmail,FILTER_VALIDATE_EMAIL) != true){
                    $formErrors[] = 'This Is Email Is Not Valid';
                }
              }
              

            if(empty($formErrors)){
                // Chech If User found In Database Or Not 
              $userCheck = $con->prepare("SELECT Username FROM users WHERE Username = ? ");
              $userCheck->execute(array($user));
              $counts = $userCheck->rowCount();

              if($counts == 1){
                $formErrors[] = 'This User is Exist , Write Another Username';
              }else{
                  $stmt = $con->prepare("INSERT INTO 
                            users(Username , Password , Email)
                            VALUES(:zuser , :zpass, :zemail)");
                 $stmt->execute(array(
                    'zuser'  => $user,
                    'zpass'  => sha1($pass1),
                    'zemail' => $email
                 ));
              }
            }
              
            $msg = 'Now , You Can Login';

        
    
        }
    }
   
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login/Sign</title>
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

<div class="container login-page">
        <h1 class="text-center" style="margin-bottom:20px">
            <span class="selected" data-class="login">Login</span> | <span data-class="signup" class="sign">Signup</span>
        </h1>
        <!-- Start Login Form -->
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <input class="form-control input-lg" type="text" name="user" placeholder="Username" autocomplete="off">
        <input class="form-control input-lg" type="password" name="pass" placeholder="Password" autocomplete="new-password">
        <input class="btn btn-lg btn-primary  btn-block" name="login" type="submit" value="Login">
    </form>


<!-- Start Sign Form -->
    <form class="signup" ction="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <input class="form-control input-lg" type="text" name="user" placeholder="Type Your Username" autocomplete="off"
        pattern=".{4,}" title="Username Must Be Larger Than 4 Characters" require>
        <input class="form-control input-lg" type="password" name="pass1" placeholder="Type A Complex Password" autocomplete="new-password" 
        minlength="4" require>
        <input class="form-control input-lg" type="password" name="pass2" placeholder="Type A Complex Password Again" autocomplete="new-password"
        minlength="4" require>
        <input class="form-control input-lg" type="email" name="email" placeholder="Type A Valid Email" require>
        <input class="btn btn-lg btn-success  btn-block" name="signup" type="submit" value="Signup">
    </form>
    
</div>
<div class="the-errors text-center">
    <?php
    if(!empty($formErrors)){
        foreach($formErrors as $error){
            echo $error . '<br>';
        }
    }
    if(isset($msg)){
        echo '<div class="success">' . $msg . '</div>';
    }

      
?>
</div>

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
		
	</body>
    </html>
