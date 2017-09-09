<?php
// Uses POST to send JSON data from client
// Saves data to mtSQL table

// add functions here

// I did that again
include_once "common/global.php";
include_once "classUserLogin.php";

$userlogin = new userLogin();

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

if ($action === "login")
{
  $result = $userlogin->Login($data);
}
else if ($action === "forgot")
{
  $result = $userlogin->Forgot($data);
}
else if ($action === "register")
{
  $result = $userlogin->Register($data);
}
else
{
  $result = createError(1001,"Invalid Action");
}

echo json_encode($result);

?>