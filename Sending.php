<?php 
    include "init.php";
    ob_start();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        echo "Welcome To You";
        $Email=filter_var($_POST['clientEmail'],FILTER_SANITIZE_STRING);
        $Message=filter_var($_POST['Message'],FILTER_SANITIZE_STRING);
        $formError=array();
        if(strlen($Email)<4){
            $formError[]="Email Must Be Greater Than 4 <stong>Characters</strong>";
        }
        if(strlen($Message)<10){
            $formError[]="Message Content Must Be Greater Than 10 <stong>Characters</strong>";
        }
        if(!empty($formError)){
            foreach($formError as $error){
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }else{
            $header='From: yousef777906@gmail.com';
            $mai=mail('yousef777906@gmail.com','About Your Ads|| Customer Messge',$Message,$header);
            if($mai){
                $second=3;
                $pre=$_SERVER['HTTP_REFERER'];
                echo "<div class='alert alert-success'>Mail Is Sending Wait Saler Message On Mail</div>";
                echo "<div class='alert alert-success'>We Will Retuen You Back in 3S</div>";
                header("refresh: 3; url = $pre");
            }else{
                $pre=$_SERVER['HTTP_REFERER'];
                echo "<div class='alert alert-danger'>Error In Sending Mail</div>";
                echo "<div class='alert alert-success'>We Will Retuen You Back in 3S</div>";
                header("refresh: 3; url = $pre");
            }
        }
    }
    ob_end_flush();
    include_once $tbl.'footer.php'; 

?>