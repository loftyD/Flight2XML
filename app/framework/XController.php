<?php
class XController {

public function getQueryStringParam($key) {

return Flight::request()->query->{$key};

}

public function getAction() {

$val = self::getQueryStringParam("action");
if(!empty($val) )
{
$val = self::getQueryStringParam("action");
return $val;
}
else
{
return false;
}

}


}

?>