<?php 
    include "conn.php";
    $tbl='include/templates/';// templates directory
    $css="layout/css/";// css directory
    $js="layout/js/";// js directory
    $lang='include/languages/';
    include "include/function/functions.php";
    include $lang."eng.php";
    include $tbl.'header.php';
    include $tbl.'footer.php';
?>