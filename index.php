<?php
require_once("app/config.php");
require_once("app/route.php");

$xml = new RoutingManager(Flight::get("f2x.dir")."/route/route.xml");

$xml->process();
?>