<?php
include_once('common\class.db.php');

class userLogin
{
    // property declaration
    public $var = 'a default value';
    public $db;

    // method declaration
    public function displayVar() 
    {
        echo $this->var;
    }

    public function __construct($database) 
    {
      $this->db = $database;      
    }


    public function action($action, $data)
    {
      if ($action === "login")
      {
        $result = $this->Login($data);
      }
      else if ($action === "forgot")
      {
        $result = $this->Forgot($data);
      }
      else if ($action === "register")
      {
        $result = $this->Register($data);
      }
      else
      {
        $result = createError(1001,"Invalid Action");
      }
      return $result;
    }

    public function Login($data)
    {      
      if (!isset($data['loginuser'])) {  $result = createError(1002,"Invalid username/password"); }
      else if (!isset($data['loginpassword'])) {  $result = createError(1002,"Invalid username/password"); }
      else 
      { // Validate username/password vs database
        if ($user = $this->db->get_array("Select id, username, fullname from users where (username = '".$data['loginuser']."' or email = '".$data['loginuser']."') and password = '".$data['loginpassword']."'"))
          { 
            // Create and return token
            $guid = GUID();
            $ipaddress = $_SERVER['REMOTE_ADDR'];
            $this->db->query("update user_session set status = 0, last_page = 'autologout' where user_id = '".$user["id"]."'");
            $this->db->query("insert into user_session (session_id, user_id, username, ip_address, last_page, status) values ('$guid','".$user["id"]."','".$user["username"]."','".$ipaddress."','Login',1)");
            $data = Array('token' => $guid, 'message' => "Login successful");
            $result = createSuccess($data); 
          }
        else
  	      { $result = createError(1002,"Invalid username/password"); }
      }
      return $result;
    }

    public function Forgot($data)
    {
      // TODO: Check user exists (username or email address)
      // TODO: send email to user
      if (!isset($data["forgotuser"])) { $result = createError(1003,"No username provided"); }
      else
        { $result = createSuccess("Reminder email sent"); }
      return $result;
    }
    
    public function Register($data)
    {
      // TODO: Scenarioas not covered
      // 1. Reregister a username
      // 2. Reregister an email
      // TODO: Send email to registered address (can be used to confirm registration or just as a link to remind them about the app)
      if (!isset($data["registeruser"])) { $result = createError(1004,"A username is required"); }
      else if (!isset($data["registerpassword"])) { $result = createError(1005,"A password is required");  }
      else if (!isset($data["registerconfirm"])) { $result = createError(1006,"A password confirmation is required");  }
      else if (!isset($data["registeremail"])) { $result = createError(1007,"An email address must be provided");  }
      else if ($data["registerpassword"] != $data["registerconfirm"]) { $result = createError(1008,"Password and Confirmation do not match");  }
      else 
      {	
        if ($this->db->query("insert into users (username, email, fullname, password) values ('".$data["registeruser"]."','".$data["registeremail"]."','','".$data["registerpassword"]."')"))
        {
          $user = $this->db->get_array("Select id, username, fullname from users where (username = '".$data["registeruser"]."')");
          $guid = GUID();
          $ipaddress = $_SERVER['REMOTE_ADDR'];
          $data = Array('token' => $guid, 'message' => "User has been registered");
          $result = createSuccess($data); 
          $this->db->query("insert into user_session (session_id, user_id, username, ip_address, last_page, status) values ('$guid','".$user["id"]."','".$user["username"]."','".$ipaddress."','Login',1)");
        }
        else
        {
          $result = createError(1009,"Cannot register user");
        }
      }
      return $result;
    }  
}
?> 