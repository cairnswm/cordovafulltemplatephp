<?php
// Uses POST to send JSON data from client
// Saves data to mySQL table

// add functions here

include_once "common/global.php";
include_once "common/config.db.php";
include_once "classes/classUserLogin.php";

$userlogin = new userLogin($database);

/* Get Posted values 
   print_r($_POST); */

// Get _GET values 
if (isset($_GET['action'])) 
  { $action = $_GET['action']; }
else
  { $action = "Invalid"; }
if (isset($_POST))
  { $data = $_POST; } 
else
  { $data = Array(); }

$result = $userlogin->action($action,$data);

echo json_encode($result);

?>