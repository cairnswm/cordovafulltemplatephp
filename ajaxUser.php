<?php
// Uses POST to send JSON data from client
// Saves data to mtSQL table

// add functions here

// I did that again
include_once "global.php";

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
  if (!isset($data["loginuser"])) { $result = createError(1002,"Invalid username/password"); }
  else if (!isset($data["loginpassword"])) { $result = createError(1002,"Invalid username/password");  }
  else 
  {
  	$username = $data["loginuser"];
  	$password = $data["loginpassword"];
  	if ($username === "cairnswm" && $password === "yolandec")
  		{  	$result = createSuccess("Login successful"); }
  	else
  		{ $result = createError(1002,"Invalid username/password"); }
  }
}
else if ($action === "forgot")
{
  if (!isset($data["forgotuser"])) { $result = createError(1003,"No username provided"); }
  else
  {	$result = createSuccess("Reminder email sent"); }
}
else if ($action === "register")
{
  if (!isset($data["registeruser"])) { $result = createError(1004,"A username is required"); }
  else if (!isset($data["registerpassword"])) { $result = createError(1005,"A password is required");  }
  else if (!isset($data["registerconfirm"])) { $result = createError(1006,"A password confirmation is required");  }
  else if (!isset($data["registeremail"])) { $result = createError(1007,"An email address must be provided");  }
  else if ($data["registerpassword"] != $data["registerconfirm"]) { $result = createError(1008,"Password and Confirmation do not match");  }
  else 
  {	$result = createSuccess("User has been registered"); }
}
else
{
  $result = createError(1001,"Invalid Action");
}

echo json_encode($result);

?>