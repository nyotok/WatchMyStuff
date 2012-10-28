<?
    
    function connect($host = '', $user = '', $pass = '', $name = '')
    {
        global $db_host, $db_user, $db_pass, $db_name;
        
        if(!strlen($host) || !strlen($user) || !strlen($name))
        {
            $host = $db_host;
            $user = $db_user;
            $pass = $db_pass;
            $name = $db_name;
            $sw = 1;
        }
        
        $lnk = mysql_connect($host, $user, $pass,true) or print_v("Unable to connect do database!",true);
        mysql_select_db($name) or print_v("Unable to select database!",true);
        
        if($sw)
        {
            global $primaryLink;
            $primaryLink = $lnk;
        }
        
        return $lnk;
    }
    
    function select($flds, $table, $where = '',$ord = '',$group = '',$limit = '', $lnk = false)
    {
        $q = 'SELECT '.$flds.' FROM '.$table.' WHERE 1';
        if(strlen($where))
            $q .= ' AND '.$where;
        if(strlen($group))
            $q .= ' GROUP BY '.$group;
        if(strlen($ord))
            $q .= ' ORDER BY '.$ord;
        if(strlen($limit))
            $q .= ' LIMIT '.$limit;
        
        if(!$lnk)
        {
            global $primaryLink;
            $lnk = $primaryLink;
        }
		
        $r = run_query($q,$lnk);        
        $arr = array();
        if(mysql_num_rows($r))
            while($d = mysql_fetch_assoc($r))
            {
                $keys = array_keys($d);
                foreach($keys AS $key)
                    $d[$key] = stripslashes($d[$key]);
                $arr[] = $d;
            }
        if((count($arr) == 1) && (count($arr[0]) == 1))
            $arr = current($arr[0]);
        
        return $arr;
    }
    
    function insert($table,$vals, $id_fld = 'id')
    {
        global $db_tables, $primaryLink;
        
        $id = $vals[$id_fld];
        $q_flds = $q_vals = '';
        
        foreach($db_tables[$table] AS $fld)
        {
            if($fld != $id_fld && isset($vals[$fld]))
                if($id)
                    $q_vals .= $fld."='".addslashes($vals[$fld])."',";
                else
                {
                    $q_flds .= $fld.',';
                    $q_vals .= "'".addslashes($vals[$fld])."',";
                }
        }
        
        if($id)
            $q = "UPDATE ".$table." SET ".substr($q_vals,0,strlen($q_vals)-1)." WHERE ".$id_fld."='".$id."'";
        else
            $q = "INSERT INTO ".$table." (".substr($q_flds,0,strlen($q_flds)-1).") VALUES (".substr($q_vals,0,strlen($q_vals)-1).")"; 
        
        //printf($q);die;
        $r = run_query($q);		
		
        if($id)
            return $id;
        else
            return mysql_insert_id($primaryLink);
    }
    
    function delete($table,$where)
    {
        run_query("DELETE FROM ".$table." WHERE ".$where);
    }
    
    function run_query($q,$lnk = false)
    {
        global $debug, $debug_mes;
        
        if(!$lnk)
        {
            global $primaryLink;
            $lnk = $primaryLink;   
        }
        
        
        $qStart = microtime(true);
        $r = mysql_query($q,$lnk);
        $qEnd = microtime(true);
        
        $err = mysql_error($lnk);
        
        return $r;
    }
    
    function shift($arr)
    {
        if(count($arr))
            return $arr[0];
        else
            return array();
    }
    
    function escape($str)
    {
        global $primaryLink;
        
        //if(get_magic_quotes_gpc())
            //return $str;
        //else
            return mysql_real_escape_string($str,$primaryLink);
    }

?>