<?php

function isValidURL($url)
{
	return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

// example of how to modify HTML contents
include('../simple_html_dom.php');

$url = 'http://www.emag.ro/';

// get DOM from URL or file
$html = file_get_html($url);

// remove all image
foreach($html->find('link') as $e)
{
	if(!isValidURL($e->href))
		$e->href = $url.$e->href;
}
    
foreach($html->find('script') as $e)
{
	if(!isValidURL($e->src))
		$e->src = $url.$e->src;
}	
	
echo $html;
die;

// remove all image
foreach($html->find('img') as $e)
    $e->outertext = '';

// replace all input
foreach($html->find('input') as $e)
    $e->outertext = '[INPUT]';

// dump contents
echo $html;
?>