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

function GUID()
{ return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32769,49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function SanitizeAsInt($input, $default=0)
{
	if (filter_var($input, FILTER_VALIDATE_INT)) {
	    return $integer;
	} else {
	    return $default;
	}
}
?>