<?php
use PHPUnit\Framework\TestCase;
$baseDir = realpath(dirname(__FILE__));
include_once $baseDir."/../common\global.php";
include_once $baseDir."/../common/config.db.php";

class ajaxUserTest extends TestCase
{
    public function testInvalidAction()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1001,"message":"Invalid Action"}');
        $_GET["action"] = "invalid";
        include $baseDir."\..\ajaxUser.php"; 
    }
    public function testInvalidLoginParameters()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1002,"message":"Invalid username\/password"}');
        $_GET["action"] = "login";
        $_POST = "";
        include $baseDir."\..\ajaxUser.php";
    }
    public function testInvalidLoginNoUsername()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1002,"message":"Invalid username\/password"}');
        $_GET["action"] = "login";
        $_POST["loginpassword"] = "password";
        include $baseDir."\..\ajaxUser.php"; 
    }
    public function testInvalidLoginNoPassword()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1002,"message":"Invalid username\/password"}');
        $_GET["action"] = "login";
        $_POST["loginuser"] = "username";
        include $baseDir."\..\ajaxUser.php"; 
    }
    public function testIncorrectLoginPassword()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1002,"message":"Invalid username\/password"}');
        $_GET["action"] = "login";
        $_POST["loginuser"] = "cairnswm";
        $_POST["loginpassword"] = "wrong";
        include $baseDir."\..\ajaxUser.php"; 
    }
    public function testCorrectLoginParameters()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"S","data":"Login successful"}');
        $_GET["action"] = "login";
        $_POST["loginuser"] = "cairnswm";
        $_POST["loginpassword"] = "password";
        include $baseDir."\..\ajaxUser.php"; 
    }

    public function testIncorrectForgetParameters()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1003,"message":"No username provided"}');
        $_GET["action"] = "forgot";
        include $baseDir."\..\ajaxUser.php"; 
    }    
    public function testCorrectForgetParameters()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"S","data":"Reminder email sent"}');
        $_GET["action"] = "forgot";
        $_POST["forgotuser"] = "cairnswm";
        include $baseDir."\..\ajaxUser.php"; 
    }    

    public function testIncorrectRegisterUsernameMissing()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1004,"message":"A username is required"}');
        $_GET["action"] = "register";
        include $baseDir."\..\ajaxUser.php"; 
    }    
    public function testIncorrectRegisterPasswordMissing()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1005,"message":"A password is required"}');
        $_GET["action"] = "register";
        $_POST["registeruser"] = "cairnswm";
        include $baseDir."\..\ajaxUser.php"; 
    }    
    public function testIncorrectRegisterConfirmMissing()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1006,"message":"A password confirmation is required"}');
        $_GET["action"] = "register";
        $_POST["registeruser"] = "cairnswm";
        $_POST["registerpassword"] = "cairnswm";
        include $baseDir."\..\ajaxUser.php"; 
    }    
    public function testIncorrectRegisterEmailMissing()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1007,"message":"An email address must be provided"}');
        $_GET["action"] = "register";
        $_POST["registeruser"] = "cairnswm";
        $_POST["registerpassword"] = "cairnswm";
        $_POST["registerconfirm"] = "cairnswm";
        include $baseDir."\..\ajaxUser.php"; 
    }    
    public function testIncorrectRegisterPasswordDoesNotMatchConfirm()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"E","error":1008,"message":"Password and Confirmation do not match"}');
        $_GET["action"] = "register";
        $_POST["registeruser"] = "cairnswm";
        $_POST["registerpassword"] = "cairnswm";
        $_POST["registerconfirm"] = "CONFIRM";
        $_POST["registeremail"] = "cairnswm@gmail.com";
        include $baseDir."\..\ajaxUser.php"; 
    }    
    public function testCorrectRegisterParameters()
    {
        global $baseDir, $database;
        $this->expectOutputString('{"status":"S","data":"User has been registered"}');
        $_GET["action"] = "register";
        $_POST["registeruser"] = "cairnswm";
        $_POST["registerpassword"] = "cairnswm";
        $_POST["registerconfirm"] = "cairnswm";
        $_POST["registeremail"] = "cairnswm@gmail.com";
        include $baseDir."\..\ajaxUser.php"; 
    }    

}
?>