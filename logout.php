<?php
    $ID=isset($_GET['ID'])?$_GET["ID"]:0;
    include "conn.php";
    $stat="update users3 set Online=0 , Last=now() where user_id='$ID'";
    $ex=mysqli_query($con,$stat);
    session_start();
    session_unset();
    // or $_SESSION()=array();
    session_destroy();
    header('Location:index.php');
    exit();
?>