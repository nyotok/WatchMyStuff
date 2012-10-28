<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="ro" />
<meta name="resource-type" content="document" />
<meta name="keywords" content="monitorizare, continut, web, pagini, notificari" />
<meta name="description" content="Alege continutul tau preferat de pe web si fi notificat cand apare ceva nou." />
<link rel="stylesheet" type="text/css" href="css/mystyle.css" />
<title>watchmystuff. Fi la curent cu tot ce te intereseaza</title>
</head>
<body>
	<div class="wrapper">
    	<div class="login register">
        	<img src="images/wms_logo.png" alt="watchmystuff logo" title="watchmystuff"/>
            <h2>Alege continutul tau preferat de pe web si fi notificat cand apare ceva nou.</h2>
            <div class="box">
            	<h1>Inregistrare</h1>
                <form class="clearfix" action="" method="post">
                    <label for="name">Nume:</label>
                    <input type="text" name="name" id="name" value="<?php echo (isset($_POST['name']) ? $_POST['name'] : '')?>" />
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" id="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : '')?>" />
                    <label for="password">Parola:</label>
                    <input type="password" name="password" id="password" />
                    <label for="password">Confirmare parola:</label>
                    <input type="password" name="conf_password" id="conf_password" />
                    <input type="checkbox" />
                    <label for="remember">Tine-ma logat</label>
                    <a class="right" href="">Am uitat parola</a>
                    <input class="btn orange border5" type="submit" name="submit" value="Salveaza" />
                    
                    <div class="clearfix"></div>
                    <?php
                        echo $error;
                    ?>
                    <div class="clearfix"></div>
                </form>
                <a class="right" href="<?=$websiteURL.'login.php'?>">Ai cont? Locheaza-te acum!</a>
            </div>
        </div>
    </div>
</body>
</html>


