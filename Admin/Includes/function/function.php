<?php
    // Function For Get Title 
    function getTitle(){
        
        global $pageTitle;

        if(isset($pageTitle)){
            echo $pageTitle;
        }else{
            echo 'PowerPack';
        }
    }

    /* Redirect Function */
    function redirectHome($errorMsg,$urlPage , $seconds){
        echo "<div class='alert alert-danger'>$errorMsg</div>";
        echo "<div class='alert alert-info'>You Will Be Redirected to Homepage After $seconds Seconds.</div>";
        header("refresh: $seconds; url=$urlPage");
        exit();
    }

    function redirectBack($successMesg,$urlHome , $seconds = 3){
        echo "<div class='alert alert-success'>$successMesg</div>";
        echo "<div class='alert alert-info'>You Will Be Redirected to Homepage After $seconds Seconds.</div>";
        header("refresh: $seconds; url=$urlHome");
        exit();
    }
// Count Any Table
    function countRow($col , $table){
        global $con;
        $stmt2 = $con-> prepare("SELECT COUNT($col) FROM $table");
        $stmt2 ->execute();
        return $stmt2->fetchColumn();
    }
// Count Users In users Table

    function countUser(){
        global $con;
        $stmt2 = $con-> prepare("SELECT COUNT('UserID') FROM users Where GroupID = 0 ");
        $stmt2 ->execute();
        return $stmt2->fetchColumn();
    }
    // Count Admin In users Table

    function countAdmin(){
        global $con;
        $stmt2 = $con-> prepare("SELECT COUNT('UserID') FROM users Where GroupID = 1 ");
        $stmt2 ->execute();
        return $stmt2->fetchColumn();
    }

    // Check Items function
    function checkIteme( $select,$from ,$values){
        global $con;
        $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ? ");
        $statement->execute(array($values));
        $count = $statement->rowCount();
        return $count;

    }
    // Latest User In The Table 
    function getLastUser($select,$table,$order,$limit){
        global $con;
        $stmt = $con->prepare("SELECT $select FROM $table WHERE GroupID = 0 ORDER BY $order DESC LIMIT $limit ");
        $stmt ->execute(); 
        $row = $stmt->fetchAll();
        return $row;
    }

     // Latest User In The Table 
     function getLastOrder(){
        global $con;
        $stmt1 = $con->prepare("SELECT requseteden.ProductID ,requseteden.DateOrder, productsen.ProductID,
        productsen.ProductNameEn FROM requseteden , productsen WHERE requseteden.ProductID = productsen.ProductID
        ORDER BY RequestID DESC LIMIT 3");
        $stmt1 ->execute();
        return $stmt1->fetchAll();
    }