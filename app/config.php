<?php

$flight_dir = "PATH_TO_FLIGHT"; 
include($flight_dir./"Flight.php");

/*
 *
 * Changeable Configuration below.
 */

Flight::set("f2x.dir","flightxml/app"); // Directory Of Flight2XML



/*
 *
 * You can configure the folder paths here, but you'll need to move all of the existing views, classes and controllers to their new location.
 */

Flight::set("f2x.views.path",Flight::get("f2x.dir")."/views/");
Flight::set("f2x.classes.path",Flight::get("f2x.dir")."/classes/");
Flight::set("f2x.controllers.path",Flight::get("f2x.dir")."/controllers");

?>