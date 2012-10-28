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

// Try to store the $_GET params in the $_SESSION for further reference
storeSessionParams();

if (! isLogged() && ! tokenLogin()) {
    //header('Location: '.$websiteURL.'login.php');
    var_dump($_GET['token']);
    var_dump($_SESSION);
    exit;
}

if (! checkSessionParams()) {
    header('Location: '.$websiteURL.'index.php');
}

if (isSetDetails()) {
    if (isValidRequest()) {
        insertUserData();
    } else {
        // Eroare
    }
    header('Location: '.$websiteURL.'index.php');
} else {
    $error = "Te rugam sa completezi campurile. ";
}

// Se include pagina
include('pages/set_stuff_details.php');
        
   