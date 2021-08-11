<?php
    session_start();
    $pageTitle = 'Contact Us';
    if (isset($_SESSION['Username'])) {
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
        if ($do == 'Manage') {
            $stmt = $con->prepare("SELECT * FROM contactus ");
            $stmt->execute();  # Execute The Statement
            // Assign To Variable
            $rows = $stmt->fetchAll();
        } elseif ($do == 'Edit') {
            $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
            $stmt = $con->prepare("SELECT * FROM contactus WHERE id = ? LIMIT 1 ");
            $stmt->execute(array($id));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
        
            if ($stmt-> rowCount() > 0) {
                ?>
    <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
    Edit Contact List</h1>

    <div class="container">
    <a href="contact-us.php?do=Manage" class="btn btn-primary" 
            style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
            <i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i>  </a>

        <form class="form-horizontal" action="Contact.php?do=Update" method="POST">

            <input type="hidden" name="id" value="<?php echo $id ?>">

           <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Email</label>
               <div class="col-sm-10 col-md-6">
                   <input type="email" name="email" class="form-control" required="required" 
                   value="<?php echo $row['Email']?>" placeholder="Email"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Telephone</label>
               <div class="col-sm-10 col-md-6">
                   <input type="phone" name="phone1" class="form-control" required="required"
                   placeholder="Enter Your First Phone Number " value="<?php echo $row['Telephone1']?>" />
               </div> 
            </div>
            <div class="form-group form-group-lg">
            <label type="hidden" class="col-sm-2 control-label"></label>
            <div class="col-sm-10 col-md-6">
                   <input type="phone" name="phone2" class="form-control" 
                   placeholder="Enter Your Second Phone Number" value="<?php echo $row['Telephone2']?>"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Location</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="locationEn" class="form-control" value="<?php echo $row['LocationEn']?>"
                   placeholder="Location For Product " required="required"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
            <label type="hidden" class="col-sm-2 control-label"></label>
                <div class="col-sm-10 col-md-6">
                   <input type="text" name="locationAr" class="form-control" value="<?php echo $row['LocationAr']?>"
                    placeholder="الموقع" style="direction:rtl" required="required"/>
               </div> 
            </div> 

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Facebook</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="facebook" class="form-control" value="<?php echo $row['facebook'] ?>"
                   placeholder="Facebook Link " required="required"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Instagram</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="instgram" class="form-control" value="<?php echo $row['instgram'] ?>"
                   placeholder="Instagram Link " required="required"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Twitter</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="twitter" class="form-control" value="<?php echo $row['twitter'] ?>"
                   placeholder="Twitter Link " required="required"/>
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
            } else {
                echo 'No Such ID';
            }
        } elseif ($do == 'Update') {?>
            <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
            Update Contact List</h1>
            <div class="container">
  <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id             = $_POST['id'];
                $email          = $_POST['email'];
                $phone1         = $_POST['phone1'];
                $phone2         = $_POST['phone2'];
                $locationEn     = $_POST['locationEn'];
                $locationAr     = $_POST['locationAr'];
                $facebook       = $_POST['facebook'];
                $instgram       = $_POST['instgram'];
                $twitter        = $_POST['twitter'];
  
              $fromErrors = array();
              if(empty($email)){
                $fromErrors[] = '<div class="alert alert-danger">Email Can\'t Be Empty</div>';
            }
            if(empty($phone1)){
                $fromErrors[] = '<div class="alert alert-danger">Phone Number Can\'t Be Empty</div>';
            }
            if(empty($locationEn)){
                $fromErrors[] = '<div class="alert alert-danger">Location Can\'t Be Empty</div> ';
            }
            if(empty($locationAr)){
                $fromErrors[] = '<div class="alert alert-danger">Location Can\'t Be Empty</div> ';
            }
            if(empty($facebook)){
                $fromErrors[] = '<div class="alert alert-danger">Facebook Link Can\'t Be Empty</div> ';
            }
            if(empty($instgram)){
                $fromErrors[] = '<div class="alert alert-danger">Instagram Link Can\'t Be Empty</div> ';
            }
            if(empty($twitter)){
                $fromErrors[] = '<div class="alert alert-danger">Twitter Link Can\'t Be Empty</div> ';
            }
            foreach($fromErrors as $error){
                echo $error . '<br/>';
            }
            if(empty($fromErrors)){
  
              $stmt = $con->prepare("UPDATE contactus SET Email = ?,Telephone1 = ?, Telephone2 = ?, 
              LocationEn = ?,LocationAr = ?, facebook = ? , instgram = ? , twitter = ? WHERE id = ?");
              $stmt->execute(array($email,$phone1,$phone2,$locationEn,$locationAr,$facebook,$instgram,$twitter,$id));
  
              $successMesg  = $stmt->rowCount() . ' Record Update';
              $urlHome = 'contact-us.php';
              redirectBack($successMesg,$urlHome,3);
  
             }
          }
        
          }

            include $tpl . 'footer.php';
        } else {
            header('Location: index.php');
            exit();
        }
    

