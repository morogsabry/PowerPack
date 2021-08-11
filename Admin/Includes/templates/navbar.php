<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Power Pack</a>
    </div> 

    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a href="dashboard.php"><i class="fa fa-dashboard" style="font-size:18px;color:#008dde"></i>  Dashboard</a></li>
        <li class="dropdown open">
          <a class="dropdown-toggle" href="#" id="menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons" style="font-size:18px;color:#008dde">&#xe8b8; </i> Settings
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">

            <li><a class="dropdown-item" href="user-menu.php">
            <i class="fa fa-users" style="font-size:16px;color:#008dde"></i> User Menu</a></li>

            <li><a class="dropdown-item" href="products-menu-en.php">
            <i class="fa fa-file-text" style="font-size:16px;color:#008dde"></i> Products Menu</a></li>

            <li><a class="dropdown-item" href="themes-setting.php">
            <i class="fa fa-image" style="font-size:16px;color:#008dde"></i> Themes Setting</a></li>

            <li><a class="dropdown-item" href="image.php">
            <i class="fa fa-image" style="font-size:16px;color:#008dde"></i> Image Of Pages</a></li>

            <li><a class="dropdown-item" href="contact-us.php">
            <i class="material-icons" style="font-size:16px;color:#008dde">&#xe8c5;</i> Contact Us</a></li>
            
          </ul>
          <li><a href="orders.php"><i class="fa fa-file-text" style="font-size:16px;color:#008dde"></i> Orders</a></li>
          <li><a href="question.php"><i class="fa fa-question" style="font-size:16px;color:#008dde"></i> Questions</a></li>
      </ul>	

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown open">
          <a class="dropdown-toggle" href="#" id="menu" role="button" data-toggle="dropdown" 
          aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user" style="font-size:16px;color:#008dde"></i>
           <span><?php echo $_SESSION['Username']?></span> <span class="caret"></span> 
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="profile.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>">
            <i class="material-icons" style="font-size:16px;color:#008dde">&#xe8b8;</i> Setting</a></li>
            <li><a class="dropdown-item" href="Logout.php">
            <i class="fa fa-unlock-alt" style="font-size:16px;color:#008dde"></i> Logout</a></li>
          </ul>
          
        </li>
      </ul>
    </div>
    
  </div>
</nav>