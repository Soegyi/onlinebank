<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    $mySqlHost = "localhost";
    $mySqlUser = "root";
    $mySqlPassword = "";
    $mydatabase="onlinebank";
    
    
   $connection= mysqli_connect($mySqlHost,$mySqlUser,$mySqlPassword,$mydatabase)or
   die("Cannot connect to the database");
   if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
}

   ?>