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
    	<div class="login register">
        	<img src="images/wms_logo.png" alt="watchmystuff logo" title="watchmystuff"/>
            <h2>Alege continutul tau preferat de pe web si fi notificat cand apare ceva nou! Simplu si eficient cu ajutorul bookmarklet-ului din contul tau.</h2>
            <div class="box">
            	<h1>Salveaza detalii</h1>
                <form class="clearfix" action="" method="post">
                    <p>
                        <label for="email">Titlu:</label>
                        <input type="text" name="title" id="title" value="<?php echo (isset($_POST['title']) ? $_POST['title'] : '')?>" />
                    </p>
                    <p>
                        <label for="text">Descriere (optional):</label>
                        <input type="text" name="text" id="text" value="<?php echo (isset($_POST['text']) ? $_POST['text'] : '')?>" />
                    </p>
                    <p>
                        <input class="btn orange border5" type="submit" name="submit" value="Salveaza" />
                    
                    </p>
                    
                    <div class="clearfix">
                        <?php
                            echo $error;
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>