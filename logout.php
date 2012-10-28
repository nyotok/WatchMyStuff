<?php
session_start();
header("Content-Type: text/html; charset=utf-8");

include('includes/config.inc.php');
include('includes/db.tables.inc.php'); // Descrierea tabelelor din baza de date
include('includes/functions/db.functions.php'); // Functii pentru baza de date
include('includes/functions/functions.php');
include('simplehtmldom/simple_html_dom.php');

connect(); // Conectare la baza de date
//==========================================================================

if (! isLogged())
{
    header('Location: '.$websiteURL.'login.php');
}

logout();

header('Location: index.php');
        