<?php 
    include "conn.php";
    $tbl='include/templates/';// templates directory
    $css="layout/css/";// css directory
    $js="layout/js/";// js directory
    $lang='include/languages/';
    include "include/function/functions.php";
    include $tbl.'header.php';
    include $lang."eng.php";
    if(!isset($nonavbar)){
        include $tbl.'navbar.php';
         include $tbl.'footer.php';
    }
    include $tbl.'footer.php';
    $res=get_included_files();

?>