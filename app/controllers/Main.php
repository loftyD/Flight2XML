<?php
require(__DIR__."/../framework/XController.php");
class MainController extends XController {

function init() {

$action = self::getAction();


if($action === false) {

Flight::render(Flight::get("f2x.views.path")."home");

}

}

}

?>