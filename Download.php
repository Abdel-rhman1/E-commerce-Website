<?php 
    include "conn.php";
    $id=isset($_GET['ID'])?$_GET['ID']:0;
    $pdf="select * from item3 where ID='$id'";
    $ex=mysqli_query($con,$pdf);
    $name=mysqli_fetch_assoc($ex)['pdf'];
    $fileName="admin\Uploads\Pdfs\\"."$name";
    $type="application/pdf";
    $filemode="inline";
    if(isset($_GET['do'])){
        if($_GET['do']=='Down')
            $filemode="attachment";
    }
    header("Content-type:".$type);
    header("Content-Disposition:".$filemode.";filename=".$fileName);
    header("Content-Length:".filesize($fileName));
    readfile($fileName);
?>
