<?php 
    session_start();
    session_unset();
    // or $_SESSION()=array();
    session_destroy();
    header('Location:index.php');
    exit();
?>