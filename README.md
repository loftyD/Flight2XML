# Flight2XML
Offers XML based routing that runs on top of FlightPHP

#Instructions on Setting Up#

1. First , you'll need to download FlightPHP. Instructions for that , can be found at http://flightphp.com/install/
2. Then download Flight2XML. Upload to your server or local environment, then open flightxml/app/config.php and edit the configuration settings there.
3. Create your index.php with the following code:

```php

<?php
require_once("PATH TO FLIGHTPHP");
require_once("app/route.php");

$xml = new RoutingManager("flightxml/app/route/route.xml");

$xml->process();
?>

```
(Obviously substitute PATH TO FLIGHTPHP with the location of FlightPHP and make sure you get the path correct for the XML file.)

4. And you're all setup! For information on how the XML is formed, please see XML.md
