<?
    function send_mail($to,$subject,$message)
    {
        global $fromMail,$fromName;

        if(setare(2))
                $fromMail = setare(2);
        if(setare(8))
                $fromName = setare(8);

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        // Additional headers
        $headers .= 'To: '.$to. "\r\n";
        $headers .= "From: $fromName <$fromMail> \r\n";

        mail($to,$subject,$message,$headers);
    }
    
    
    
    function login()
    {
        if(isset($_POST['submit']))
        {
            $email = mysql_real_escape_string($_POST['email']);
            $password = mysql_real_escape_string($_POST['password']);

            $where = "email = '".$email."' AND ";
            $where .= "password = '".md5($password)."' ";
            $user = select('user_id', 'users', $where);

            if($user)
            {
                $_SESSION['user_id'] = $user;
                return true;
            }
            else
                return "Datele de logare sunt incorecte";
        }
        return false;
    }
    
    function getUser()
    {
        if(!isset($_SESSION['user_id']))
            return false;
        
        $where = "user_id = '".$_SESSION['user_id']."' ";
        $user = shift(select('*', 'users', $where));
        
        return $user;
    }
    
    
    function getUserStuff()
    {
        if(!isset($_SESSION['user_id']))
            return false;
        
        $where = "user_id = '".$_SESSION['user_id']."' ";
        return select('*', 'user_stuffs', $where);
    }
    
    function isLogged()
    {
        if($_SESSION['user_id'])
        {
            return true;
        }
        else
            return false;
    }
    
    function tokenLogin()
    {
        if (! $_GET['token']) return false;
        
        $where = "token = '".mysql_real_escape_string($_GET['token'])."'";
        $user = select('user_id', 'users', $where);
        
        if($user)
        {
            $_SESSION['user_id'] = $user;
            return true;
        }
        else
            return false;
    }
    
    /**
     * Try to store the received $_GET params in the session, in order to
     * use them after the login/registration 
     */
    function storeSessionParams() {
        if (isset($_GET['url']) && isset($_GET['tag'])) {
            $_SESSION['url'] = $_GET['url'];
            $_SESSION['tag'] = $_GET['tag'];
        }
    }
    
    function checkSessionParams() {
        return (isset($_SESSION['url']) && isset($_SESSION['tag']));
    }
    
    function isValidGetRequest() {
        if (isset($_GET['url']) && isset($_GET['tag'])) {
            $url = $_GET['url'];
            $tag = $_GET['tag'];
        }
        
        if($ok)
        {
            //parsez html
            $result = parse_html($url, $tag);
            
            //daca elementul este unic/identificabil
            if(sizeof($result) != 1)
            {
                die('Nu se poate identifica elementul. Va rugam sa selectati un nivel mai sus :D ');
                return false;
            }
        }
        return true;
    }
    
    function isValidRequest()
    {
        $ok = false;
        if(isset($_GET['url']) && isset($_GET['tag']))
        {
            $url = $_GET['url'];
            $tag = $_GET['tag'];
            $ok = true;
        }
        
        if(isset($_POST['url']) && isset($_POST['tag']))
        {
            $url = $_POST['url'];
            $tag = $_POST['tag'];
            $ok = true;
        }
        
        if($ok)
        {
            //parsez html
            $result = parse_html($url, $tag);
            
            //daca elementul este unic/identificabil
            if(sizeof($result) != 1)
            {
                die('Nu se poate identifica elementul. Va rugam sa selectati un o zona de continut mai mare');
                return false;
            }
        }
        return true;
    }
    
    
    function isSetDetails()
    {
        if(isset($_POST['title']) && isset($_POST['text']) && ($_POST['title']!='') && $_POST['text']!='')
        {
            return true;
        }
        else
            return false;
    }
    
    function insertUserData()
    {
        parse_html($_SESSION['url'], $_SESSION['tag']);
        list($result) = $result;
        
        $where = "url = '".mysql_real_escape_string($_SESSION['url'])."' AND ";
        $where .= "tag = '".mysql_real_escape_string($_SESSION['tag'])."' AND ";
        $where .= "user_id = '".$_SESSION['user_id']."' ";
        $exist = select('id', 'user_stuffs', $where);
        
        $insert = array(
            'user_id' => $_SESSION['user_id'],
            'url' => $_SESSION['url'],
            'tag' => $_SESSION['tag'],
            'title' => $_POST['title'],
            'text' => $_POST['text']
        );
        
        $insert = array_map('mysql_real_escape_string', $insert);
        $insert['plaintext'] = md5($result->plaintext);
        $insert['created_on'] = date('Y-m-d H:i:s');
        
        if($exist)
        {
            $insert['id'] = $exist['id'];
        }
        return insert('user_stuffs', $insert,'id');
    }
    
    
    function cron_check_for_new_content()
    {
        // caut combinatiile url, tag distincte pentru a cauta in net modificari 
        $distinct_tags = select("distinct(Concat_ws('_', url,tag)), url,tag", 'user_stuffs');
        
        if($distinct_tags)
            foreach($distinct_tags as $row)
            {
                //parsez html
                $result = parse_html($row['url'], $row['tag']);

                //daca nu mai pot identifica portiunea de cod html in mod unnic
                if(sizeof($result) != 1)
                {
                    $update = array(
                        'id'  => $row['id'],
                        'time_modified' => date('Y-m-d H:i:s'),
                        'status'  => 2 // not found
                    );
                    
                    insert('user_stuffs', $update,'id');
                }
                else
                {
                    $plaintext = md5($result->plaintext);
                    // daca s-a modificat, inregistrez in db
                    if($update['plaintext'] != $row['plaintext'])
                    {
                        $update = array(
                            'id'  => $row['id'],
                            'time_modified' => date('Y-m-d H:i:s'),
                            'status'  => 1,
                            'plaintext' => $plaintext
                        );

                        insert('user_stuffs', $update,'id');
                    }
                }
            }
    }
    
    function parse_html($url, $tag)
    {
        $html = file_get_html($url);
        $result = $html->find($tag);
        return $result;
    }
    
    function register()
    {
        if(isset($_POST['submit']))
        {
            if($_POST['name'] != '' && $_POST['email']!='' && $_POST['password']!='' && $_POST['conf_password']!='')
            {
                $_POST['name'] = mysql_real_escape_string($_POST['name']);
                $_POST['email'] = mysql_real_escape_string($_POST['email']);
                $_POST['password'] = mysql_real_escape_string($_POST['password']);
                $_POST['conf_password'] = mysql_real_escape_string($_POST['conf_password']);
                
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    return "Emailul este incorect.";
                }
                
                if ($_POST['password'] != $_POST['conf_password']) {
                    return "Campul parola si Confirmare parola nu coincid";
                }
                
                $where = "email = '".$_POST['email']."' ";
                $exist = select('user_id', 'users', $where);
                if($exist){
                    return "Contul exista deja";
                }
                else
                {
                    $insert = array(
                            'name' => $_POST['name'],
                            'email' => $_POST['email'],
                            'password' => md5($_POST['password']),
                            'token' => md5($_POST['password']),
                        );
                    
                    $user_id = insert('users', $insert, 'user_id'); 
                    $_SESSION['user_id'] = $user_id;
                    return true;
                }
            }
            else
                return "Te rugam sa completezi toate campurile.";
        }
        return false;
    }
    
    function logout()
    {
        session_destroy();
        unset($_SESSION);
    }