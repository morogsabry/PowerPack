<?php
    session_start();
    $pageTitle = 'Images Setting';
    if (isset($_SESSION['Username'])){
        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;

        if ($do == 'Manage') {
            $stmt = $con->prepare("SELECT * FROM imagesofpages");
            $stmt->execute();  # Execute The Statement
            // Assign To Variable
            $rows = $stmt->fetchAll(); ?>
        
            <h1 class="text-center" style="margin-top: 20px">View Items</h1>
            <div class="container">

                <div class="table-responsive">
                    <table class="main-table manage-product1 text-center table table-bordered">
                        <tr>
                            <td>#Image ID</td>
                            <td>Image</td>
                            <td>Page Name</td>
                            <td>Control</td>		
                        </tr>
                        <?php
                        foreach ($rows as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['id']."</td>";
                            echo "<td><img src='Uploades/ImageOfPages/" . $row['imagePath']. "' alt='' /></td>";
                            echo "<td>" . $row['GroupId']."</td>";
                            echo "<td>
                                <a href='image-edit.php?do=Edit&imageid=" . $row['id'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                                <a href='image.php?do=Delete&imageid=" . $row['id'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>
                                </td>";
                        } ?>
                    </table>
                </div>
                <a href="image.php?do=Add" class="btn btn-primary" style="margin-bottom: 35px"><i class="fa fa-plus"></i>  New Image</a>
            </div>
  <?php
        }elseif($do == 'Add'){?>
			<h1 class="text-center" style="margin-top: 20px;">Add Theme</h1>

        <div class="container">
        <a href="image.php?do=Manage" class="btn btn-primary" 
            style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
            <i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i>  </a>

        <form class="form-horizontal" action="image.php?do=Insert" method="POST" 
        enctype="multipart/form-data">

       
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Image Of Page</label>
               <div class="col-sm-10 col-md-6">
                   <input type="file" name="image" class="form-control" required="required"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Image Name</label>		
                <div class="col-sm-10 col-md-6">
                <select name="groupid" class="form-control" require>
                    <option>Select Your Page Name</option>
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

}elseif($do == 'Delete'){
    echo "<h1 class='text-center'>Delete Product</h1>";
    echo "<div class='container'>";
        // Check If Get Request userid Is Numeric & Get The Integer Value Of It 
        $imageid = isset($_GET['imageid']) && is_numeric($_GET['imageid']) ? intval($_GET['imageid']): 0;
        // Select All Data Depend on this ID
        $stmt = $con->prepare("SELECT * FROM imagesofpages WHERE id = ? LIMIT 1");
        // Execute Query
        $stmt->execute(array($imageid));
        // Fetch The Data
        $row = $stmt->fetch();
        // The Row Count
        $count = $stmt->rowCount();
    // If There's Such ID Show The Form
    if($stmt->rowCount() > 0){
        $stmt = $con->prepare("DELETE FROM imagesofpages WHERE id = :zid");
        $stmt->bindParam(":zid" , $imageid);
        $stmt->execute();
    echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted';

    }else{
        echo "Good This Id Is Not Exist";
    } }elseif($do == 'Insert'){
# Insert Product Page ...
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo "<h1 class='text-center'>Insert Product</h1>";
            echo "<div class='container'>";

            $imageName = $_FILES['image']['name'];
            $imageSize = $_FILES['image']['size'];
            $imageTmp = $_FILES['image']['tmp_name'];
            $imageType = $_FILES['image']['type'];

            $imageAllowedExtension = array("jpeg","jpg" , "png","gif","jfif");

            $imageExtension = strtolower(end(explode('.',$imageName)));

            $groupid  = $_POST['groupid'];
            // Validate The Form
            $formErrors = array();
            if(! empty($imageName) && ! in_array($imageExtension , $imageAllowedExtension)){
                $formErrors[] = 'This Extension Is Not <strong>Allowed</strong>';
            }
            if(empty($imageName)){
                $formErrors[] = 'Image Product Is <strong>Required</strong>';
            }
            if($imageSize > 4194304){
                $formErrors[] = 'Image Cant Be Larger Than <strong>4MG</strong>';
            }
            // Loop Into Errors Array And Echo It
            foreach ($formErrors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>' ;
                # code...
            }

// Check If There's No Error Proceed The Updata Operation 
    if(empty($formErrors)){
    
        $image = rand(0, 1000000000000) . '_' . $imageName;
        move_uploaded_file($imageTmp , "Uploades/ImageOfPages//" . $image);
            $stmt = $con->prepare("INSERT INTO 
                            imagesofpages(imagePath, GroupId)
                            VALUES(:zimage , :zgroupid)");
            $stmt->execute(array(
                'zimage'     => $image,
                'zgroupid'   => $groupid
            ));
        
            // Echo Success Message 
               $successMesg  = $stmt->rowCount() . ' Record Inserted';
               $urlHome = 'image.php';
               redirectBack($successMesg,$urlHome,3);

            }
}
        }else{
            $errorMsg = 'Sorry You Can\'t Browse This Page Directly';
            $urlPage = 'image.php';
            redirectHome($errorMsg,$urlPage , 3);

        }
    
    
    echo "</div>";
    
        
        include $tpl . 'footer.php';
    }else {
        header('Location: index.php');
        exit();
    }
?>
