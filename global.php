<?php
// Global functions
function createError($errorNum, $errorMsg)
{
	return array("status" => "E", "error" => $errorNum, "message" => $errorMsg);
}
function createSuccess($data)
{
	return array("status" => "S", "data" => $data);
}
?>