<?php
    session_start();
    $pageTitle = 'Images Editing ';
    if (isset($_SESSION['Username'])) {
        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;

        if ($do == 'Manage') {
            $stmt = $con->prepare("SELECT * FROM imagesofpages");
            $stmt->execute();  # Execute The Statement
            // Assign To Variable
            $rows = $stmt->fetchAll(); ?>
        
            
  <?php
        } elseif ($do == 'Edit') {
            $imageid = isset($_GET['imageid']) && is_numeric($_GET['imageid']) ? intval($_GET['imageid']) : 0;
            $stmt = $con->prepare("SELECT * FROM imagesofpages WHERE id = ? LIMIT 1 ");
            $stmt->execute(array($imageid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
        
            if ($stmt-> rowCount() > 0) {
                ?>
    <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
    Edit Image Data</h1>
    <div class="container">

    <a href="image.php?do=Manage" class="btn btn-primary" 
            style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
            <i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i>  </a>

        <form class="form-horizontal" action="image-edit.php?do=Update" method="POST" 
        enctype="multipart/form-data">

            <input type="hidden" name="imageid" value="<?php echo $imageid ?>">
          
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Image</label>
               <?php echo "<img src='Uploades/ImageOfPages/" . $row['imagePath']. "' alt='' width= 450 />";?>
            </div>

            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Image Name</label>		
                <div class="col-sm-10 col-md-6">
                <select name="groupid" class="form-control" require>
                    <option><?php echo $row['GroupId'] ?></option>
                    <option value="vision$mission">Vision & Mission</option>
                    <option value="machines">Machines</option>
                    <option value="qualitycontrol">Quality Control</option>
                    <option value="factory">Factory</option>
                    <option value="applications">Applications</option>
                    <option value="products">Products</option>
                    <option value="materials">Materials</option>
                    <option value="advantages">Advantages</option>
                </select>
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
          Update Image </h1>
          <div class="container">
<?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              $imageid = $_POST['imageid'];
              $groupid = $_POST['groupid'];

              $stmt = $con->prepare("UPDATE imagesofpages SET GroupId = ? WHERE id = ?");
                  $stmt->execute(array($groupid,$imageid));

                  $successMesg  = $stmt->rowCount() . ' Record Update';
                  $urlHome = 'image.php';
                  redirectBack($successMesg, $urlHome, 3);
          }
      
        
        
        include $tpl . 'footer.php';
    } else {
        header('Location: index.php');
        exit();
    }
    }
