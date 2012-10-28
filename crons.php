<?php

    include('includes/config.inc.php');
    include('includes/db.tables.inc.php'); // Descrierea tabelelor din baza de date
    include('includes/functions/db.functions.php'); // Functii pentru baza de date
    include('includes/functions/functions.php');
    include('simplehtmldom/simple_html_dom.php');
    
    connect(); // Conectare la baza de date
    
    cron_check_for_new_content();
    