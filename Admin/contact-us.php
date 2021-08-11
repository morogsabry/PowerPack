<?php
    session_start();
    $pageTitle = 'Contact Us';
    if (isset($_SESSION['Username'])){
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
        if ($do == 'Manage') {
            $stmt = $con->prepare("SELECT * FROM contactus ");
            $stmt->execute();  # Execute The Statement 
            // Assign To Variable
            $rows = $stmt->fetchAll();?>
            <h1 class="text-center" style="margin-top: 20px">Manage Contact List</h1>
				<div class="container">
					<div class="table-responsive">
						<table class="main-table text-center table table-bordered">
							<tr>
                                <td>#ID</td>
								<td>Email</td>
								<td>Telephone</td>
								<td>Location</td>
                                <td>Social Media</td>
								<td>Control</td>
							</tr>
							<?php 
                    foreach ($rows as $row) {
                        echo "<tr>";
                            echo "<td>" . $row['id']."</td>";
                            echo "<td>" . $row['Email']."</td>";
                            echo "<td>
                            <i>" . $row['Telephone1']."</i><br>
                            <i>" . $row['Telephone2']."</i>
                            </td>";
                            echo "<td>
                            <i>" . $row['LocationEn']."</i><br>
                            <i>" . $row['LocationAr']."</i>
                            </td>";
                            echo "<td>
                            <i>" . $row['facebook']."</i><br>
                            <i>" . $row['instgram']."</i>
                            <i>" . $row['twitter']."</i>
                            </td>";
                            echo "<td>
                                <a style='margin-bottom:10px' href='Contact.php?do=Edit&id=" . $row['id'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                                <a style='margin-bottom:10px' href='contact-us.php?do=Delete&id=" . $row['id'] . "' class='btn btn-danger'><i class='fa fa-close'></i> Delete</a>
                                </td>";
                        
                        
							echo "</tr>";
					}

							?>
									

						</table>
					</div>
					<a href="contact-us.php?do=Add" class="btn btn-primary" style="margin-bottom: 35px"><i class="fa fa-plus"></i>  New Member</a>
				</div>
				

		<?php 
        }elseif($do == 'Add'){?>
            <h1 class="text-center" style="margin-top: 20px;">Add Member</h1>

        <div class="container">
        <a href="contact-us.php?do=Manage" class="btn btn-primary" 
            style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
            <i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i>  </a>

        <form class="form-horizontal" action="contact-us.php?do=Insert" method="POST">

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Email</label>
               <div class="col-sm-10 col-md-6">
                   <input type="email" name="email" class="form-control" required="required" 
                   placeholder="Email"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Telephone</label>
               <div class="col-sm-10 col-md-6">
                   <input type="phone" name="phone1" class="form-control" placeholder="Enter Your First Phone Number " required="required"/>
               </div> 
            </div>
            <div class="form-group form-group-lg">
            <label type="hidden" class="col-sm-2 control-label"></label>
            <div class="col-sm-10 col-md-6">
                   <input type="phone" name="phone2" class="form-control" placeholder="Enter Your Second Phone Number"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Location</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="locationEn" class="form-control" placeholder="Location For Product " required="required"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
            <label type="hidden" class="col-sm-2 control-label"></label>
                <div class="col-sm-10 col-md-6">
                   <input type="text" name="locationAr" class="form-control" 
                    autocomplete="off" placeholder="الموقع" style="direction:rtl" required="required"/>
               </div> 
            </div> 

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Facebook</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="facebook" class="form-control" 
                   placeholder="Facebook Link " required="required"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Instagram</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="instgram" class="form-control" 
                   placeholder="Instagram Link " required="required"/>
               </div> 
            </div>

            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Twitter</label>
               <div class="col-sm-10 col-md-6">
                   <input type="text" name="twitter" class="form-control" 
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
}elseif($do == 'Delete'){

    echo "<h1 class='text-center'> Delete Contact List</h1>";
    echo "<div class='container'>";
        // Check If Get Request userid Is Numeric & Get The Integer Value Of It 
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']): 0;
        // Select All Data Depend on this ID
        $stmt = $con->prepare("SELECT * FROM contactus WHERE id = ? LIMIT 1");
        // Execute Query
        $stmt->execute(array($id));
        // Fetch The Data
        $row = $stmt->fetch();
        // The Row Count
        $count = $stmt->rowCount();
    // If There's Such ID Show The Form
    if($stmt->rowCount() > 0){
        $stmt = $con->prepare("DELETE FROM contactus WHERE id = :zid");
        $stmt->bindParam(":zid" , $id);
        $stmt->execute();
    echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted';

    }else{
        echo "Good This Id Is Not Exist";
    }

echo "</div>";
}elseif($do == 'Insert'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<h1 class='text-center'>Insert Contact Data</h1>";
        echo "<div class='container'>";

        $email          = $_POST['email'];
        $phone1         = $_POST['phone1'];
        $phone2         = $_POST['phone2'];
        $locationEn     = $_POST['locationEn'];
        $locationAr     = $_POST['locationAr'];
        $facebook         = $_POST['facebook'];
        $instgram         = $_POST['instgram'];
        $twitter         = $_POST['twitter'];
      

        $formErrors = array();
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
        // Loop Into Errors Array And Echo It
        foreach ($formErrors as $error) {
            echo '<div class="alert alert-danger">' . $error . '</div>' ;
            # code...
        }

// Check If There's No Error Proceed The Updata Operation 
if(empty($formErrors)){

        $stmt = $con->prepare("INSERT INTO 
                        contactus(Email,Telephone1,Telephone2,LocationEn,LocationAr,facebook,instgram,twitter)
                        VALUES(:zemail,:zphone1,:zphone2,:zlocationEn,:zlocationAr,:zfacebook ,:zinstgram,:ztwitter)");
        $stmt->execute(array(
            'zemail'      => $email,
            'zphone1'     => $phone1,
            'zphone2'     => $phone2,
            'zlocationEn' => $locationEn,
            'zlocationAr' => $locationAr,
            'zfacebook'   => $facebook,
            'zinstgram'  => $instgram,
            'ztwitter'    => $twitter
           
        ));
    
        // Echo Success Message 
           $successMesg  = $stmt->rowCount() . ' Record Inserted';
           $urlHome = 'contact-us.php';
           redirectBack($successMesg,$urlHome,3);

        }
}
    }else{
        $errorMsg = 'Sorry You Can\'t Browse This Page Directly';
        $urlPage = 'contact-us.php';
        redirectHome($errorMsg,$urlPage , 3);

    }
        

        include $tpl . 'footer.php';
    }else {
        header('Location: index.php');
        exit();
    }

