<?php
use PHPUnit\Framework\TestCase;
$baseDir = realpath(dirname(__FILE__));
include_once $baseDir."\..\common\global.php";

class globalTest extends TestCase
{
    /* public function testPushAndPop()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    } */

    public function testCreateError()
    {
        $json = createError(1,"Test Error Message");
        $this->assertEquals(3,count($json));
        $this->assertEquals('E',$json["status"]);
        $this->assertEquals('1',$json["error"]);
        $this->assertEquals('Test Error Message',$json["message"]);
    }
    public function testCreateSuccess()
    {
        $json = createSuccess(Array("message" => "Success"));
        $this->assertEquals(2,count($json));
        $this->assertEquals(1,count($json["data"]));
    }    
    public function TestSanitizeAsInt()
    {
        $this->AssertEquals(SanitizeAsInt(1),1);
        $this->AssertEquals(SanitizeAsInt("1"),1);
        $this->AssertEquals(SanitizeAsInt(1,0),1);
        $this->AssertEquals(SanitizeAsInt("1",0),1);
        $this->AssertEquals(SanitizeAsInt("One"),0);
        $this->AssertEquals(SanitizeAsInt("0ne",1),1);
        $this->AssertEquals(SanitizeAsInt("1A"),0);
        $this->AssertEquals(SanitizeAsInt("1A",1),1);

    }
}
?>