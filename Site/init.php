<?php

    include 'connect.php';
  
    $sessionUser = '';
    if(isset($_SESSION['user']))
    {
        global $sessionUser ;
        $sessionUser = $_SESSION['user'];
    }