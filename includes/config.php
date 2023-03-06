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

    define("DBHOST", "studentmysql.miun.se");
    define("DBUSER", "luha2200");
    define("DBPASSWORD", "jordenrunt");
    define("DBDATABASE", "blogsdb");

    
} else{
    //databasinsätllningar - publicerat
}

?>