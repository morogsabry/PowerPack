<?php
	session_start();
	include 'init.php';
	include 'Includes/header-ar.php';
	if (isset($_SESSION['user'])){
		$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();

		$getOrder = $con->prepare("SELECT * FROM productsen , requseteden ,users WHERE
		 productsen.ProductID = requseteden.ProductID AND 
		 users.UserID = requseteden.UserID ");
		 $getOrder->execute();
		 $orders = $getOrder->fetchAll();

		 $getQuestions = $con->prepare("SELECT quations.* , users .UserID FROM quations ,users WHERE 
		 users.UserID = quations.UserID");
		 $getQuestions->execute();
		 $Questions = $getQuestions->fetchAll();
		
?>
<!-- User Data -->
<h1 class="text-center" style="font-size: 50px;font-weight: bold; margin-top:50px;color:#040e26">
  الحساب الشخصى </h1>
  <div class="information block" style="font-size: 18px;font-family: 'arial';color: #FFF;">
    <div class="container">
      <div class="panel panel-primary" style="border-color: #040e26;margin-bottom: 20px; background-color: #fff;
border: 2px solid #040e26;border-radius: 4px;box-shadow: 0 1px 1px rgb(0 0 0 / 5%)">
        <div class="panel-heading" style="color: #fff;background-color: #040e26;border-color: #040e26;
		padding: 10px 15px;border-bottom: 1px solid transparent;border-top-left-radius: 3px;
		border-top-right-radius: 3px;text-align:right">
		المعـــــلومات الشخصية</div>
		<div class="panel-body" style="padding: 15px;color:#000;direction:rtl">
		<button class="btn btn-primary pull-left" >
			<a href="edit-profile.php?do=Edit&userid=<?php echo $info['UserID'] ?>" style="color:#040e26">
			تعديل الحساب</a></button>
			<div style="text-align:right;direction:rlt">
			الإسم : <?php echo $info['Username'] ?><br>
				البريد الإلكترونى 	: <?php echo $info['Email'] ?><br>
				الهاتف 	: <?php echo $info['Phone'] ?><br>
				العنوان : <?php echo $info['Address'] ?><br>
			</div>
			</div>
		</div>
	</div>
</div>
<!-- Order Data -->
<div class="information block" style="font-size: 18px;font-family: 'arial';color: #FFF;">
    <div class="container">
      <div class="panel panel-primary" style="border-color: #040e26;margin-bottom: 20px; background-color: #fff;
    border: 2px solid #040e26;border-radius: 4px;box-shadow: 0 1px 1px rgb(0 0 0 / 5%)">
        <div class="panel-heading" style="color: #fff;background-color: #040e26;border-color: #040e26;
		padding: 10px 15px;border-bottom: 1px solid transparent;border-top-left-radius: 3px;
		border-top-right-radius: 3px;text-align:right">
		قائــــــــمة الطلبات </div>
		<div class="panel-body" style="padding: 15px;color:#040e26;direction:rtl;max-height:400px;overflow:scroll">
<?php
		foreach($orders as $order){
			if($info['UserID'] == $order['UserID'] ){
					?>
				<div style="text-align:right;direction:rlt">
				أسم المنتج 	: 
				<?php echo $order['ProductNameEn']?> - <?php echo $order['ProductNameAr']?><br>
				السعر :
				 <?php echo $order['Price'] ?><br>
				وصف الطلب 	: 
				<?php echo $order['Message'] ?><br>
				رسالة تأكيد الطلب	:
				 <?php echo $order['ConfirmOrder'] ?><br>
				وقت الطلب : 
				<?php echo $order['DateOrder'] ?><br>
			<hr>
			</div>
	<?php	
			}
		}
        
	?>	</div></div>
	</div>
</div>

<!-- Question Data -->
<div class="information block" style="font-size: 18px;font-family: 'arial';color: #FFF;">
    <div class="container">
      <div class="panel panel-primary" style="border-color: #040e26;margin-bottom: 20px; background-color: #fff;
    border: 2px solid #040e26;border-radius: 4px;box-shadow: 0 1px 1px rgb(0 0 0 / 5%)">
        <div class="panel-heading" style="color: #fff;background-color: #040e26;border-color: #040e26;
		padding: 10px 15px;border-bottom: 1px solid transparent;border-top-left-radius: 3px;
		border-top-right-radius: 3px;text-align:right">
		الإستفــــــسارات </div>
		<div class="panel-body" style="padding: 15px;color:#040e26;direction:rtl;max-height:400px;overflow:scroll">
<?php
		foreach($Questions as $Question){
			if($info['UserID'] == $Question['UserID'] ){
					?>
				<div style="text-align:right;direction:rlt">
				الموضوع 	: 
				<?php echo $Question['Subject']?><br>
				الإستفسار :
				<?php echo $Question['Message'] ?><br>
				وقت الإستفسار 	: 
				<?php echo $Question['DateQuestion'] ?><br>
				رد المسئول	:
				<?php echo $Question['Response'] ?><br>
				
			<hr>
			</div>
	<?php	
			}
		}		
        
	?>	</div></div>
	</div>
</div>
<?php
		}else{
			header("Location: Login.php");
			exit();
		}	
	include 'Includes/footer-ar.php';
?>