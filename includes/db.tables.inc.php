<?
                
$db_tables = array();
            
$db_tables['users'] = array('user_id','name', 'email','password','token');
$db_tables['user_stuffs'] = array('id','user_id','title','text', 'url','tag','plaintext', 'tags','created_on','time_modified','status');
