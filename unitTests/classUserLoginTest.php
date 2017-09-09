<?php
use PHPUnit\Framework\TestCase;
$baseDir = realpath(dirname(__FILE__));
include_once $baseDir."\..\common\global.php";
include_once $baseDir."\..\classUserLogin.php";

class ClassUserLoginTest extends TestCase
{
    public function testIncorrectLoginPassword()
    {
        $userlogin = new userLogin();
        $data = Array('loginuser' => 'cairnswm', 'loginpassword' => 'wrongpassword');
        $output = $userlogin->Login($data);
        $this->assertEquals('{"status":"E","error":1002,"message":"Invalid username\/password"}',json_encode($output));
    }
    public function testInvalidLoginNoUsername()
    {
        $userlogin = new userLogin();
        $data = Array('loginpassword' => 'wrongpassword');
        $output = $userlogin->Login($data);
        $this->assertEquals('{"status":"E","error":1002,"message":"Invalid username\/password"}',json_encode($output));
    }
    public function testInvalidLoginNoPassword()
    {
        $userlogin = new userLogin();
        $data = Array('loginuser' => 'cairnswm');
        $output = $userlogin->Login($data);
        $this->assertEquals('{"status":"E","error":1002,"message":"Invalid username\/password"}',json_encode($output));
    }
    public function testCoorrectLoginPassword()
    {
        $userlogin = new userLogin();
        $data = Array('loginuser' => 'cairnswm', 'loginpassword' => 'password');
        $output = $userlogin->Login($data);
        $this->assertEquals('{"status":"S","data":"Login successful"}',json_encode($output));
    }
    
    public function testIncorrectForgetParameters()
    {
        $userlogin = new userLogin();
        $data = Array();
        $output = $userlogin->Forgot($data);
        $this->assertEquals('{"status":"E","error":1003,"message":"No username provided"}',json_encode($output));
     }
    public function testCorrectForgetParameters()
    {
        $userlogin = new userLogin();
        $data = Array('forgotuser' => 'cairnswm');
        $output = $userlogin->Forgot($data);
        $this->assertEquals('{"status":"S","data":"Reminder email sent"}',json_encode($output));
    }

    public function testIncorrectRegisterUsernameMissing()
    {
        $userlogin = new userLogin();
        $data = Array();
        $output = $userlogin->Register($data);
        $this->assertEquals('{"status":"E","error":1004,"message":"A username is required"}',json_encode($output));
    }
    public function testIncorrectRegisterPasswordMissing()
    {
        $userlogin = new userLogin();
        $data = Array('registeruser' => 'username');
        $output = $userlogin->Register($data);
        $this->assertEquals('{"status":"E","error":1005,"message":"A password is required"}',json_encode($output));
    }
    public function testIncorrectRegisterConfirmMissing()
    {
        $userlogin = new userLogin();
        $data = Array('registeruser' => 'username', 'registerpassword' => 'password');
        $output = $userlogin->Register($data);
        $this->assertEquals('{"status":"E","error":1006,"message":"A password confirmation is required"}',json_encode($output));
    }
    public function testIncorrectRegisterEmailMissing()
    {
        $userlogin = new userLogin();
        $data = Array('registeruser' => 'username', 'registerpassword' => 'password', 'registerconfirm' => 'password');
        $output = $userlogin->Register($data);
        $this->assertEquals('{"status":"E","error":1007,"message":"An email address must be provided"}',json_encode($output));
    }
    public function testIncorrectRegisterPasswordDoesNotMatchConfirm()
    {
        $userlogin = new userLogin();
        $data = Array('registeruser' => 'username', 'registerpassword' => 'password', 'registerconfirm' => 'wrongpassword', 'registeremail' => 'e@mail.com');
        $output = $userlogin->Register($data);
        $this->assertEquals('{"status":"E","error":1008,"message":"Password and Confirmation do not match"}',json_encode($output));
    }
    public function testCorrectRegisterParameters()
    {
        $userlogin = new userLogin();
        $data = Array('registeruser' => 'username', 'registerpassword' => 'password', 'registerconfirm' => 'password', 'registeremail' => 'e@mail.com');
        $output = $userlogin->Register($data);
        $this->assertEquals('{"status":"S","data":"User has been registered"}',json_encode($output));
    }
}
?>