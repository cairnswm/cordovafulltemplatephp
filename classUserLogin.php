<?php
include_once('common\config.db.php');

class userLogin
{
    // property declaration
    public $var = 'a default value';

    // method declaration
    public function displayVar() {
        echo $this->var;
    }

    public function Login($data)
    {
      if (!isset($data['loginuser'])) {  $result = createError(1002,"Invalid username/password"); }
      else if (!isset($data['loginpassword'])) {  $result = createError(1002,"Invalid username/password"); }
      else if ($data['loginuser'] === "cairnswm" && $data['loginpassword'] === "password")
        { $result = createSuccess("Login successful"); }
      else
  	{ $result = createError(1002,"Invalid username/password"); }
      return $result;
    }

    public function Forgot($data)
    {
      if (!isset($data["forgotuser"])) { $result = createError(1003,"No username provided"); }
      else
        { $result = createSuccess("Reminder email sent"); }
      return $result;
    }
    
    public function Register($data)
    {
      if (!isset($data["registeruser"])) { $result = createError(1004,"A username is required"); }
      else if (!isset($data["registerpassword"])) { $result = createError(1005,"A password is required");  }
      else if (!isset($data["registerconfirm"])) { $result = createError(1006,"A password confirmation is required");  }
      else if (!isset($data["registeremail"])) { $result = createError(1007,"An email address must be provided");  }
      else if ($data["registerpassword"] != $data["registerconfirm"]) { $result = createError(1008,"Password and Confirmation do not match");  }
      else 
      {	$result = createSuccess("User has been registered"); }
      return $result;
    }  
}
?> 