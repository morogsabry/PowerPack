<?php
    session_start();
    $pageTitle = 'Dashboard';
    if (isset($_SESSION['Username'])){
        include 'init.php';
      $limit = 3;
?>
    <div class="container home-stats text-center">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="stat st-members">
                    Total Member
                    <span><a href="user-menu.php">
                        <?php echo countUser() ?></a>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-admin">
                    Total Admin
                    <span><a href="user-menu.php">
                        <?php echo countAdmin() ?></a>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-product">
                    Total Product
                    <span><a href="products-menu-en.php">
                        <?php echo countRow('ProductID','productsen') ?></a>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-order">
                    Total Order
                    <span><a href="orders.php">
                        <?php echo countRow('RequestID','requseteden') ?></a>
                    </span>
                </div>
            </div>
        
        </div>
    </div>
    <div class="container latest" >
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> Latest <?php echo $limit ?> Registered Users
                    </div>
                    <div class="panel-body"><?php

                    $LastUsers = getLastUser('*','users','UserID',$limit);
                    foreach($LastUsers as $LastUser){?>
                    <div>
                    <h5 style="font-size:20px"><i class='fa fa-user' style='font-size:18px;color:red'></i>
                    <?php echo  $LastUser['Username'] ?></h5>
                    <h6 style="font-size:16px;margin-top:-10px">
                    <i class='material-icons' style='font-size:18px;color:red'>&#xe0be;</i>
                    <?php echo  $LastUser['Email'] ?></h6><hr>
                    </div>
            <?php         }

               ?>    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-tag"></i> Latest 3 Oreders
                    </div>
                    <div class="panel-body"><?php

                    $LastOrders = getLastOrder();
                    foreach($LastOrders as $LastOrder){?>
                    <div>
                    <h5 style="font-size:20px"><i class='fa fa-product-hunt' style='font-size:18px;color:red'></i>
                    <?php echo  $LastOrder['ProductNameEn'] ?></h5>
                    <h6 style="font-size:16px;margin-top:-7px">
                    <i class='material-icons' style='font-size:18px;color:red'>&#xe923;</i>
                    <?php echo  $LastOrder['DateOrder'] ?></h6><hr>
                    </div>
            <?php         }

               ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
      include $tpl . 'footer.php';
    }else {
        header('Location: index.php');
        exit();
    }
?>
