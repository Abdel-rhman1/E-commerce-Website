<?php 
    function lang( string $phase):string{
        static $langs=array(

            'message'=>'مرحبا بك في موقعنا',
            'Admin' =>'مدير النظام',
        );
        return $langs[$phase];
    }
?>