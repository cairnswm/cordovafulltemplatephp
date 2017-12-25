<?php
include_once('common/class.db.php');

class DataLayer
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
      if ($action === "list")
      {
        $result = $this->ListData($data);
      }
      else
      {
        $result = createError(1001,"Invalid Action");
      } 
      return $result;
    }

    public function ListData($data)
    {      
      if (isset($data['start'])) {  $start = SanitizeAsInt($data['start'],0); } else { $start = 0; }
      if (isset($data['pagesize'])) {  $pagesize = SanitizeAsInt($data['pagesize'],20); } else { $pagesize = 20; }
      $data = $this->db->get_results("Select id, name, detail from data_table limit $start, $pagesize");
      $result = createSuccess($data); 
      return $result;
    }

    public function Forgot($data)
    {
      // TODO: Check user exists (username or email address)
      // TODO: Send email to user
      if (!isset($data["forgotuser"])) { $result = createError(1003,"No username provided"); }
      else
        { $result = createSuccess("Reminder email sent"); }
      return $result;
    }
    
    public function Register($data)
    {
      // TODO: Scenarios not covered
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