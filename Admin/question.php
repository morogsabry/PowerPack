<?php
/*
	================================================
	== Mange Members Page
	== You Can Add | Edit | Delete Members From Here
	================================================
	*/
	session_start();
	$pageTitle = 'Question List';
    if (isset($_SESSION['Username'])) {
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
        // Start Manage Page
    if ($do == 'Manage') { # Manage Members Page
        // Select All Users Except Admin
        $stmt = $con->prepare("SELECT * , users.UserID , users.Username FROM 
        quations , users WHERE quations.UserID = users.UserID");
        $stmt->execute();  # Execute The Statement
        // Assign To Variable
        $rows = $stmt->fetchAll(); ?>
				<h1 class="text-center" style="margin-top: 20px">Question List</h1>
				<div class="container">
					<div class="table-responsive">
						<table class="main-table manage-product text-center table table-bordered">
							<tr>
                                <td>#ID</td>
                                <td>Username</td>
								<td>Question</td>
								<td>Message Response</td>
								<td>Response</td>
							</tr>
							<?php
                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['QID']."</td>";
                                echo "<td>" . $row['Username']."</td>";
                                echo "<td>
                                    <i style='fontsize:25px;color:#CCC'>" . $row['Subject']."</i><br>
                                    <i>" . $row['Message']."</i>
                                 </td>"; 
                                 echo "<td>" . $row['Response']."</td>";
                                echo "<td>
								<a href='question.php?do=Add&questionid=" . $row['QID'] . "' class='btn btn-primary'  style='margin-top:15px'>
								<i class='fa fa-reply'></i> Response</a>
								</td>";
                            } ?>	

						</table>
					</div>
				</div>
				

		<?php
    } elseif ($do == 'Add') {
        $questionid = isset($_GET['questionid']) && is_numeric($_GET['questionid']) ? intval($_GET['questionid']) : 0;
        
        $stmt = $con->prepare("SELECT *  FROM quations  WHERE  QID = ? LIMIT 1");
        $stmt->execute(array($questionid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    
        if ($count > 0) {
            ?>

		<h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
    		Response Question</h1>
    	<div class="container">

			<a href="question.php?do=Manage" class="btn btn-primary" 
				style="margin-top:15px;margin-bottom:15px;background-color: transparent;font-size:18px">
				<i class="fa fa-angle-left" style="font-size:30px">&#xf104; Back</i></a>

			<form class="form-horizontal" action="question.php?do=Insert" method="POST">

				<input type="hidden" name="questionid" value="<?php echo $questionid?>">

			<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label">Question : </label>

				<div class="col-sm-10 col-md-6 col-md-lg">
                    <input style="max-height: 200px" type="text" class="form-control"
                    value="<?php echo $row['Subject']?>" readonly><br>
                    <input style="max-height: 200px" type="text" class="form-control"
                    value="<?php echo $row['Message']?>" readonly>
                </div>
			</div> 
           		
				<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label">Response Message</label>
				<div class="col-sm-10 col-md-6">
					<input style="height: 180px" type="text" name="message" class="form-control" 
					value="<?php echo $row['Response'] ?>"  placeholder="Confirm This Order" />
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
  }      } elseif ($do == 'Insert') { ?>
          <h1 class="text-center" style="color:#FFF; font-size: 50px; margin: 40px 0px; font-weight: bold;">
          Update Response</h1>
          <div class="container">
<?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              if(empty($_POST['message'])){
                  $error = 'Please, Write Your Response For This Question';
              }
              if(empty($error)){
                $msg = $_POST['message'];
                $questionid = $_POST['questionid'];

                $stmt = $con->prepare("UPDATE quations SET Response = ? WHERE QID = ?");
                $stmt->execute(array($msg,$questionid));
                $successMesg  = $stmt->rowCount() . ' Record Update';
                $urlHome = 'question.php';
                redirectBack($successMesg,$urlHome,3);
              }else{
                  echo $error;
              }
              
			  
          }
        }
    
    include $tpl . 'footer.php';
    } else {
        header('Location: index.php');
        exit();
    }
    
