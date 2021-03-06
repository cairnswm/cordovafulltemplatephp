<?php
// Uses POST to send JSON data from client
// Saves data to mySQL table

// add functions here

$baseDir = realpath(dirname(__FILE__));
include_once $baseDir."/common\global.php";
include_once $baseDir."/common/config.db.php";
include_once $baseDir."/classes/classUserLogin.php";

      if (!isset($database))
      {
        $result = createError(1999,"No database error");
        return $result;
      }
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