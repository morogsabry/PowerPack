<?php
    session_start();
    $pageTitle = 'Profile';
    if (isset($_SESSION['Username'])){
        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        // Manage Page
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
    <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">Edit Profile</h1>
    <div class="container">
    <a href="user-menu.php?do=Manage" class="btn btn-primary" 
            style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
            <i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i>  </a>
        <form class="form-horizontal" action="?do=Update" method="POST">
            <input type="hidden" name="userid" value="<?php echo $userid ?>">
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Username</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="username" class="form-control" value="<?php echo $row['Username'] ?>" autocomplete="off" required="required" placeholder="Username To Login"/>
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
          <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">Update Profile</h1>
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
            $urlHome = 'user-menu.php';
            redirectBack($successMesg,$urlHome,3);
           }
        }
      }

        include $tpl . 'footer.php';
    }else {
        header('Location: index.php');
        exit();
    }
?>
