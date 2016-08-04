<?php
require(__DIR__."/../framework/XController.php");
class TestController extends XController {



function init() {

if(strpos(Flight::request()->url,"/foo") ) {

self::pathFoo();

}
else
{
$main = true;

$action = self::getAction();

if($action === false) {

echo "default";

}

elseif($action == "load") {

echo "loading action";

}

else {
header("HTTP/1.0 404 Not Found");
echo "action not recognised";

}

}

}


function pathFoo() {
$action = self::getAction();
if($action === false) {
echo "this is foo";
}
elseif($action == "baz") {
echo "this is baz action";
}



}



}
?>
