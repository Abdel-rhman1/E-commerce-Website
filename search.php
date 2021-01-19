<?php
require "init.php";
$q = $_REQUEST["q"];
if ($q !== "") {
    $q = strtolower($q);
    $stat= "select *  from item3 where Name like '%$q%' or Description like '%$q%'";
    $ex=mysqli_query($con,$stat);
    $array=array();
    while($name = mysqli_fetch_assoc($ex)) {
        array_push($array,$name['Name']);
    }
}
?>