<?php 

// starta session
session_start();

//utseende
// $site_title
// $divider 

// ladda klasser
spl_autoload_register(function($class_name) {
    include 'classes/' . $class_name . '.class.php'; // sökväg till mapparna för klasserna
});

//utvecklarläge
$devmode = true;

if ($devmode) { // om $devmode = true;

    // Aktivera felrapportering
    error_reporting(-1);
    ini_set("display_errors", 1);

    //databasinställningar

    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASSWORD", "root");
    define("DBDATABASE", "paymentsdb");

    
} else{
    //databasinsätllningar - publicerat
}

?>