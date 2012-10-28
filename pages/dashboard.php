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
	<div class="header">
    	<div class="wrapper">
            <img src="images/wms_logo.png" alt="watchmystuff logo" title="watchmystuff" />
            <p class="right">
                
                <a class="btn orange border3 right" href="javascript:(function(){var%20WMS={authToken:'<?=$user['token']?>',jQueryVersion:'1.8.2',jQueryLoaded:function(){return((typeof%20window.jQuery!='undefined')&&(window.jQuery.fn.jquery==this.jQueryVersion));},init:function(){if(!this.jQueryLoaded()){var%20jQ=document.createElement('script');jQ.type='text/javascript';jQ.src='http://ajax.googleapis.com/ajax/libs/jquery/'+this.jQueryVersion+'/jquery.min.js';document.getElementsByTagName('body')[0].appendChild(jQ);}this.wait();},wait:function(){if(this.jQueryLoaded()){this.load();}else{setTimeout(function(){WMS.wait();},50);}},load:function(){window.jQuery.getScript('<?=$websiteURL?>js/WMSscript.js',function(){WMSauthToken=WMS.authToken;});},setToken:function(i){if(typeof%20i=='undefined')i=20;if(i<1)return%20false;if(typeof%20WMSauthToken=='string'){WMSauthToken=WMS.authToken;}else{setTimeout(function(){return%20WMS.setToken(i-1);},20);}return%20true;}};WMS.init();})();">Bookmark</a>
                
                Bun venit <strong><?=$user['name']?></strong>! 
                <a class="btn orange border3 right" href="<?=$websiteURL.'logout.php'?>">Log out</a>
            </p>
                
        </div>
    </div>
	<div class="wrapper">
    <h1>Interesele mele</h1>
    <table>
    	<tbody>
        	<tr>
            	<th><span class="ico itemico"></span>Item</th>
                <th><span class="ico statusico"></span>Status</th>
            </tr>
            <? 
                if($userStuffs)
                foreach($userStuffs as $item){?>
            <tr>
            	<td class="descriere">
                    <h2><?=$item['title']?></h2>
                    <p><?=$item['text']?></p>
                    <a class="border3" href="<?=$item['url']?>"><span class="ico linkico"></span><?=$item['url']?></a>
                    <? if($item['tags']!=''){
                        $tags = explode(',', $item['tags']);?>
                    <ul class="tags">
                        <? foreach($tags as $tag){?>
                    	<li><span></span><?=$tag?><span></span></li>
                        <? } ?>
                    </ul>
                    <?}?>
                </td>
                <?
                    if(!$item['status']){
                        $class = 'normal';
                        $text = "Nemodificat de la";
                        $data = $item['created_on'];
                    }
                    elseif($item['status']==1){
                        $class = 'update';
                        $text = "Modificat la";
                        $data = $item['time_modified'];
                    }
                    else{
                        $class = 'gone';
                        $text = "Indisponibil de la";
                        $data = $item['time_modified'];
                    }
                ?>
                <td class="status <?=$class?>">
                    <p><span class="ico <?=$class?>ico"></span><?=$text?></p>
                    <?=$data?>
                </td>
            </tr>
            <? }else{ ?>
            <tr>
            	<td class="descriere" colspan="2">
                    <p>Nu ai adaugat nici un interes pana acum.</p>
                </td>
            </tr>
            <? } ?>
        </tbody>
    </table>
    </div>
</body>
</html>