<?php
    session_start();
    $pageTitle = 'Products Menu';
    if (isset($_SESSION['Username'])) {
        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        // Manage Page
        if ($do == 'Manage') {
            $stmt = $con->prepare("SELECT * FROM productsen");
            $stmt->execute();  # Execute The Statement
            // Assign To Variable
            $rows = $stmt->fetchAll(); 
        } elseif($do == 'Edit'){
            $productid = isset($_GET['productid']) && is_numeric($_GET['productid']) ? intval($_GET['productid']) : 0;
            $stmt = $con->prepare("SELECT * FROM productsen WHERE ProductID = ? LIMIT 1 ");
            $stmt->execute(array($productid));
            $row = $stmt->fetch();  
            $count = $stmt->rowCount(); 
        
            if ($stmt-> rowCount() > 0){
            
?>
    <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
    Edit Product</h1>
    <div class="container">
    <a href="products-menu-en.php?do=Manage" class="btn btn-primary" 
            style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
            <i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i>  </a>
        <form class="form-horizontal" action="product-en.php?do=Update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="productid" value="<?php echo $productid ?>">
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Item Name</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="productnameEn" class="form-control" 
                   value="<?php echo $row['ProductNameEn'] ?>" required="required" 
                   placeholder="Product Name"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
            <label type="hidden" class="col-sm-2 control-label"></label>
                <div class="col-sm-10 col-md-6">
                   <input type="text" name="productnameAr" class="form-control" 
                   value="<?php echo $row['ProductNameAr'] ?>" required="required" 
                   placeholder="اسم المنتج" style="direction:rtl"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Description</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="descriptionEn" class="form-control" 
                   value="<?php echo $row['DescriptionEn'] ?>"  placeholder="Description for Product"/>
               </div> 
            </div>
            
            <div class="form-group form-group-lg">
            <label type="hidden" class="col-sm-2 control-label"></label>
                <div class="col-sm-10 col-md-6">
                   <input type="text" name="descriptionAr" class="form-control" 
                   value="<?php echo $row['DescriptionAr'] ?>"   
                   placeholder="الوصف" style="direction:rtl"/>
               </div> 
            </div> 

         

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Location</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="locationEn" class="form-control" 
                   value="<?php echo $row['LocationEn'] ?>" placeholder="Location For Product "/>
               </div> 
            </div>
            
            <div class="form-group form-group-lg">
            <label type="hidden" class="col-sm-2 control-label"></label>
                <div class="col-sm-10 col-md-6">
                   <input type="text" name="locationAr" class="form-control" 
                   value="<?php echo $row['LocationAr'] ?>"
                   placeholder="الموقع" style="direction:rtl"/>
               </div> 
            </div> 


            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Image</label>
               <div class="col-sm-10 col-md-6">
                   <input type="file" name="image" class="form-control" value="<?php echo $row['imagePath'] ?>"/>
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
       }else{
          echo 'No Such ID';
      } 
      }elseif($do == 'Update'){ ?>
          <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
          Update Product</h1>
          <div class="container">
<?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $productid = $_POST['productid'];
            $productnameEn = $_POST['productnameEn'];
            $productnameAr = $_POST['productnameAr'];
            $descriptionEn = $_POST['descriptionEn'];
            $descriptionAr = $_POST['descriptionAr'];
            $locationEn = $_POST['locationEn'];
            $locationAr = $_POST['locationAr'];

            $imageName = $_FILES['image']['name'];
            $imageSize = $_FILES['image']['size'];
            $imageTmp = $_FILES['image']['tmp_name'];
            $imageType = $_FILES['image']['type'];

            $imageAllowedExtension = array("jpeg","jpg" , "png","gif","jfif");

            $imageExtension = strtolower(end(explode('.', $imageName)));

            $fromErrors = array();
            if(empty($productnameEn)){
                $fromErrors[] = '<div class="alert alert-danger">Product Name Can\'t Be Empty</div>';
            }
            if(empty($productnameAr)){
                $fromErrors[] = '<div class="alert alert-danger">Product Name Can\'t Be Empty</div>';
            }
           
            if(! empty($imageName) && ! in_array($imageExtension , $imageAllowedExtension)){
                $formErrors[] = 'This Extension Is Not <strong>Allowed</strong>';
            }
            if($imageSize > 4194304){
                $formErrors[] = 'Image Cant Be Larger Than <strong>4MG</strong>';
            }

            foreach($fromErrors as $error){
                echo $error . '<br/>';
            }
           if(empty($fromErrors)){

            $image = rand(0, 1000000000000) . '_' . $imageName;
            move_uploaded_file($imageTmp , "Uploades/Products//" . $image);

            $stmt = $con->prepare("UPDATE productsen SET ProductNameEn = ?,ProductNameAr = ?, DescriptionEn = ?, DescriptionAr = ?,LocationEn = ?, LocationAr = ? , imagePath = ? WHERE ProductID = ?");
            $stmt->execute(array($productnameEn,$productnameAr,$descriptionEn,$descriptionAr,$locationEn,$locationAr,$image,$productid));

            $successMesg  = $stmt->rowCount() . ' Record Update';
            $urlHome = 'products-menu-en.php';
            redirectBack($successMesg,$urlHome,3);

           }
        }
      
        }
     include $tpl . 'footer.php';
} else {
    header('Location: index.php');

    exit();
}
