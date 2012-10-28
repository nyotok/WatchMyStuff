<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="ro" />
<meta name="resource-type" content="document" />
<meta name="keywords" content="monitorizare, continut, web, pagini, notificari" />
<meta name="description" content="Alege continutul tau preferat de pe web si fi notificat cand apare ceva nou." />
<link rel="stylesheet" type="text/css" href="css/mystyle.css" />
<title>watchmystuff. Fii la curent cu tot ce te intereseaza</title>
</head>
<body>
	<div class="wrapper">
    	<div class="login">
        	<img src="images/wms_logo.png" alt="watchmystuff logo" title="watchmystuff"/>
            <h2>Alege continutul tau preferat de pe web si fi notificat cand apare ceva nou! Simplu si eficient cu ajutorul bookmarklet-ului din contul tau.</h2>
            <div class="box">
            	<h1>Logare</h1>
                <form class="clearfix" action="" method="post">
                    <p>
                        <label for="email">E-mail:</label>
                        <input type="text" name="email" id="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : '')?>" />
                    </p>
                    <p>
                        
                    <label for="password">Parola:</label>
                    <input type="password" name="password" id="password" />
                    </p>
                    <p>
                        
                        <input type="checkbox" id="remember"/>
                        <label for="remember">Tine-ma logat</label>
                    </p>
                    <p>
                        <a class="right" href="">Am uitat parola</a>
                    </p>
                    <p>
                        <input class="btn orange border5" type="submit" name="submit" value="Logheaza-ma" />
                    </p>
                    <div class="clearfix"></div>
                    <?php
                        echo $error;
                    ?>
                    <div class="clearfix"></div>
                </form>
                
                <a class="right" href="<?=$websiteURL.'register.php'?>">Nu ai cont? Creaza-ti unul acum!</a>
            </div>
        </div>
    </div>
</body>
</html>


