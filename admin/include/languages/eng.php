<?php 
    function lang( string $phrase): string {
        static $langs = array(
            'Home_Admin'=>'Admin Area',
            'Categories'=> 'Sections',
            'Edit'=>'Edit Profile',
            'ITEM'=>'Items',
            'MEMBERS'=>'Members',
            'Comment'=>'Comments',
            'statistics'=>'Statistics',
            'LOGS'=>'Logs',
            'Setting'=>'Setting',
            'Logout'=>'Logout',

        );
        return $langs[$phrase];
    }
?>