<?php
    session_start();
    $pageTitle = 'Themes Setting';
    if (isset($_SESSION['Username'])) {
        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;

        if ($do == 'Manage') {
            $stmt = $con->prepare("SELECT * FROM themes");
            $stmt->execute();  # Execute The Statement
            // Assign To Variable
            $rows = $stmt->fetchAll(); ?>
        
            
  <?php
        } elseif ($do == 'Edit') {
            $themeid = isset($_GET['themeid']) && is_numeric($_GET['themeid']) ? intval($_GET['themeid']) : 0;
            $stmt = $con->prepare("SELECT * FROM themes WHERE ID = ? LIMIT 1 ");
            $stmt->execute(array($themeid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
        
            if ($stmt-> rowCount() > 0) {
                ?>
    <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
    Edit Theme</h1>
    <div class="container">

    <a href="themes-setting.php?do=Manage" class="btn btn-primary" 
            style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
            <i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i>  </a>

        <form class="form-horizontal" action="theme.php?do=Update" method="POST" 
        enctype="multipart/form-data">

            <input type="hidden" name="themeid" value="<?php echo $themeid ?>">
          
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Image Theme</label>
               <div class="col-sm-10 col-md-6">
                   <input type="file" name="image" class="form-control" required="required"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Theme Statue</label>
               <div class="col-sm-10 col-md-6">
                   <input name="groupid" class="form-control"  placeholder= "Enter 0 For OFF OR 1 For Active"
                   value="<?php echo $row['GroupId']?>"/>
                   0 For OFF OR 1 For Active 
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
        } elseif ($do == 'Update') { ?>
          <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
          Update Theme</h1>
          <div class="container">
<?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              $themeid = $_POST['themeid'];
              $groupid = $_POST['groupid'];

              $imageName = $_FILES['image']['name'];
              $imageSize = $_FILES['image']['size'];
              $imageTmp = $_FILES['image']['tmp_name'];
              $imageType = $_FILES['image']['type'];

              $imageAllowedExtension = array("jpeg","jpg" , "png","gif","jfif");

              $imageExtension = strtolower(end(explode('.', $imageName)));

              $fromErrors = array();
              if (! empty($imageName) && ! in_array($imageExtension, $imageAllowedExtension)) {
                  $formErrors[] = 'This Extension Is Not <strong>Allowed</strong>';
              }
              if ($imageSize > 4194304) {
                  $formErrors[] = 'Image Cant Be Larger Than <strong>4MG</strong>';
              }

              foreach ($fromErrors as $error) {
                  echo $error . '<br/>';
              }
              if (empty($fromErrors)) {
                  $image = rand(0, 1000000000000) . '_' . $imageName;
                  move_uploaded_file($imageTmp, "Uploades/Themes//" . $image);

                  $stmt = $con->prepare("UPDATE themes SET imagePath = ?,GroupId = ? WHERE ID = ?");
                  $stmt->execute(array($image,$groupid,$themeid));

                  $successMesg  = $stmt->rowCount() . ' Record Update';
                  $urlHome = 'themes-setting.php';
                  redirectBack($successMesg, $urlHome, 3);
              }
          }
      
        
        
        include $tpl . 'footer.php';
    } else {
        header('Location: index.php');
        exit();
    }
    }