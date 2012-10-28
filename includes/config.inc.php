<?
    $db_host = 'localhost';
    $db_user = 'prigix_wms';
    $db_pass = 'parola';
    $db_name = 'prigix_wms';
    
    $websiteURL = 'http://www.wms.prigix.com/';
    
    if($_SERVER['SERVER_NAME']=='localhost')
    {
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'wms';

        $websiteURL = 'http://localhost/watchmystuff/';
    }
?>