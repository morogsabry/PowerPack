<?php
    session_start();
    $pageTitle = 'Products Menu';
    if (isset($_SESSION['Username'])) {
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;

        if ($do == 'Manage') {
            $stmt = $con->prepare("SELECT * FROM productsen");
            $stmt->execute();  # Execute The Statement
            // Assign To Variable
            $rows = $stmt->fetchAll(); ?>
        
            <h1 class="text-center" style="margin-top: 20px">View Items</h1>
            <div class="container">

                <div class="table-responsive">
                    <table class="main-table manage-product text-center table table-bordered">
                        <tr>
                            <td>#Item ID</td>
                            <td>Item Name</td>
                            <td>Description</td>
                            <td>Location</td>
                            <td>Image</td>
                            <td>Control</td>		
                        </tr>
                        <?php
                        foreach ($rows as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['ProductID']."</td>";
                            echo "<td> 
                                <i>" .$row['ProductNameEn']. "</i><br>
                                <i>" .$row['ProductNameAr']. "</i>
                             </td>";
                            echo "<td> 
                                <i>" .$row['DescriptionEn']. "</i><br>
                                <i>" .$row['DescriptionAr']. "</i>
                            </td>";
                            echo "<td> 
                                <i>" .$row['LocationEn']. "</i><br>
                                <i>" .$row['LocationAr']. "</i>
                            </td>";
                            echo "<td><img src='Uploades/Products/" . $row['imagePath']. "' alt='' /></td>";
                            echo "<td>
                                <a href='product-en.php?do=Edit&productid=" . $row['ProductID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                                <a href='products-menu-en.php?do=Delete&productid=" . $row['ProductID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>
                                </td>";
                        } ?>
                    </table>
                </div>
                <a href="products-menu-en.php?do=Add" class="btn btn-primary" style="margin-bottom: 35px"><i class="fa fa-plus"></i>  New Product</a>
            </div>
  <?php
        }elseif($do == 'Add'){?>
			<h1 class="text-center" style="margin-top: 20px;">Add Product</h1>

        <div class="container">
        <a href="products-menu-en.php?do=Manage" class="btn btn-primary" 
            style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
            <i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i>  </a>
        <form class="form-horizontal" action="products-menu-en.php?do=Insert" method="POST" 
        enctype="multipart/form-data">
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Item Name</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="productnameEn" class="form-control" required="required" 
                   placeholder="Product Name"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
            <label type="hidden" class="col-sm-2 control-label"></label>
                <div class="col-sm-10 col-md-6">
                   <input type="text" name="productnameAr" class="form-control" required="required" 
                   placeholder="اسم المنتج" style="direction:rtl"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Description</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="descriptionEn" class="form-control" placeholder="Description for Product"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
            <label type="hidden" class="col-sm-2 control-label"></label>
                <div class="col-sm-10 col-md-6">
                   <input type="text" name="descriptionAr" class="form-control" 
                   placeholder="الوصف" style="direction:rtl"/>
               </div> 
            </div> 


            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Location</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="locationEn" class="form-control" placeholder="Location For Product "/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
            <label type="hidden" class="col-sm-2 control-label"></label>
                <div class="col-sm-10 col-md-6">
                   <input type="text" name="locationAr" class="form-control" 
                   placeholder="الموقع" style="direction:rtl"/>
               </div> 
            </div> 

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Image Product</label>
               <div class="col-sm-10 col-md-6">
                   <input type="file" name="image" class="form-control" required="required"/>
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
        $productid = isset($_GET['productid']) && is_numeric($_GET['productid']) ? intval($_GET['productid']): 0;
        // Select All Data Depend on this ID
        $stmt = $con->prepare("SELECT * FROM productsen WHERE ProductID = ? LIMIT 1");
        // Execute Query
        $stmt->execute(array($productid));
        // Fetch The Data
        $row = $stmt->fetch();
        // The Row Count
        $count = $stmt->rowCount();
    // If There's Such ID Show The Form
    if($stmt->rowCount() > 0){
        $stmt = $con->prepare("DELETE FROM productsen WHERE ProductID = :zproduct");
        $stmt->bindParam(":zproduct" , $productid);
        $stmt->execute();
    echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted';

    }else{
        echo "Good This Id Is Not Exist";
    }

echo "</div>";
}elseif($do == 'Insert'){
# Insert Product Page ...
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo "<h1 class='text-center'>Insert Product</h1>";
            echo "<div class='container'>";

            $productnameEn = $_POST['productnameEn'];
            $productnameAr = $_POST['productnameAr'];
            $descriptionEn = $_POST['descriptionEn'];
            $descriptionAr = $_POST['descriptionAr'];
            $locationEn    = $_POST['locationEn'];
            $locationAr    = $_POST['locationAr'];

            $imageName = $_FILES['image']['name'];
            $imageSize = $_FILES['image']['size'];
            $imageTmp = $_FILES['image']['tmp_name'];
            $imageType = $_FILES['image']['type'];

            $imageAllowedExtension = array("jpeg","jpg" , "png","gif","jfif");

            $imageExtension = strtolower(end(explode('.',$imageName)));


            // Validate The Form

            $formErrors = array();
            if(empty($productnameEn)){
                $fromErrors[] = '<div class="alert alert-danger">Product Name Can\'t Be Empty</div>';
            }
            if(empty($productnameAr)){
                $fromErrors[] = '<div class="alert alert-danger">Product Name Can\'t Be Empty</div>';
            }
            
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
    if (empty($formErrors)) {
        $image = rand(0, 1000000000000) . '_' . $imageName;
        move_uploaded_file($imageTmp, "Uploades/Products//" . $image);
        $check = checkIteme("Username", "users", $user);
        if ($check == 0) {
            $stmt = $con->prepare("INSERT INTO 
                            productsen(ProductNameEn,ProductNameAr,DescriptionEn,DescriptionAr,LocationEn,LocationAr,imagePath)
                            VALUES(:zproductnameEn,:zproductnameAr,:zdescriptionEn,:zdescriptionAr,:zlocationEn,:zlocationAr,:zimage)");
            $stmt->execute(array(
                'zproductnameEn' => $productnameEn,
                'zproductnameAr' => $productnameAr,
                'zdescriptionEn' => $descriptionEn,
                'zdescriptionAr' => $descriptionAr,
                'zlocationEn'    => $locationEn,
                'zlocationAr'    => $locationAr,
                'zimage'         => $image
            ));
        
            // Echo Success Message
            $successMesg  = $stmt->rowCount() . ' Record Inserted';
            $urlHome = 'products-menu-en.php';
            redirectBack($successMesg, $urlHome, 3);
        }
    }else{
        $errorMsg = 'Sorry, Write Another Product Name';
        $urlPage = 'products-menu-en.php';
        redirectHome($errorMsg,$urlPage, 3);
        }
}
        }else{
            $errorMsg = 'Sorry You Can\'t Browse This Page Directly';
            $urlPage = 'products-menu-en.php';
            redirectHome($errorMsg,$urlPage , 3);

        }
            
    include $tpl . 'footer.php';
        } else {
            header('Location: index.php');
        
            exit();
        }
    
?>