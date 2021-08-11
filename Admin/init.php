<?php
include 'connect.php';
    //Routes
$tpl = 'Includes/templates/';
$func = 'Includes/function/'; 
$css = 'Layout/css/';
$js = 'Layout/js/';
$img = 'Layout/images/';

// Include The Important Files
include $func . 'function.php';
include $tpl .'header.php';

// Include Navbar On All Page Expect The One With $noNavbar Variable

if (!isset($noNavbar)){
    include $tpl . 'navbar.php';
    
   
}
