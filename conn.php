<?php 
    $server='localhost:3307';
    $username='root';
    $password='';
    $database='shop';
    $con=mysqli_connect($server,$username,$password,$database);
    if(!$con){
        die( "Failed To Connect to The DataBase");
    }
    else{
    }
?>