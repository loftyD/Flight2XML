<?php
  Class RoutingManager
  {
      var $path;
      var $xml;
      
      function __construct($path)
      {
          $this->path = $path;
      }
      
     /*
      *
      * Loads XML file, specified in the constructor and returns an xml object. Returns false if file doesn't exist.
      */
      private function _load()
      {
          if (file_exists($this->path)) {
              $xml       = simplexml_load_file($this->path);
              $this->xml = $xml;
              return $xml;
          } else {
              return false;
          }
      }

     /*
      *
      * Prints the current Flight Request Object, nicely formatted too.
      */
      function getRequestParams()
      {
          echo "<pre>";
          print_r(Flight::request());
          echo "</pre>";
      }
      
     /*
      *
      * Xpath Function. Used by Flight::map()
      */
      private function _searchXMLItem($crit)
      {
          $thisXMLLocation = file_get_contents($this->path);
          $thisXML         = new SimpleXMLElement($thisXMLLocation);
          $result          = $thisXML->xpath($crit);
          return $result;
      }
      
     /*
      *
      * Parses the XML and converts it into Flight::route() calls.  Todo: Override of 404s.
      */
      function process()
      {
     
     /*
      *
      * Creates a function within flight which calls _searchXMLItem()
      */
          Flight::map('getXMLNode', function($searchRoute)
          {
              $res = self::_searchXMLItem("//route[@path='$searchRoute']");
              return $res;
          });

          if (self::_load() !== false) {
              $xml = self::_load();
              $i   = 0;
              foreach ($xml->route as $item) {
                  if ($item['disabled'] == 'true' || $item['type'] == "notFound")
                      continue;
                  $route        = (string) $item['path'];
                  $routeType    = (string) $item['type'];
                  $controller   = (string) $item->render['path'];
                  $type         = (string) $item->render['type'];
                  $name         = (string) $item->render['name'];
                  $code         = (string) $item->{header}['statusCode'];
                  $statusMsg    = (string) $item->{header}["statusMessage"];
                  $notFoundPath = (string) $item->header->render['path'] . ".php";
                  if (empty($statusMsg))
                      $statusMsg = "Not Found";
                  $searchRoute = $route;
                  if (count($item->additional->subroute) != 0) {
                      foreach ($item->additional->subroute as $subroute) {
                          $trueRoute = $route . $subroute[path];
                          if (preg_replace('/\?.*/', '', Flight::request()->url) == $trueRoute) {
                              $searchRoute = $route;
                              $route       = $trueRoute;
                              break;
                          }
                      }
                  }
                  Flight::set("controller", $controller);
                  Flight::set("renderType", $type);
                  Flight::set("renderName", $name);
                  Flight::set("route", $route);
                  Flight::set("code", $code);
                  Flight::set("statusMsg", $statusMsg);
                  Flight::set("code", $code);
                  Flight::set("notFoundPath", $notFoundPath);
                  Flight::set("routeType", $routeType);
                  Flight::set("searchRoute", $searchRoute);
                  $url = preg_replace('/\?.*/', '', Flight::request()->url);
                  if ($route == $url) {
                      Flight::route($route, function()
                      {
                          $item_f       = Flight::getXMLNode(Flight::get("searchRoute"));
                          $route        = (string) $item_f[0]['path'];
                          $routeType    = (string) $item_f[0]['type'];
                          $controller   = (string) $item_f[0]->render['path'];
                          $type         = (string) $item_f[0]->render['type'];
                          $name         = (string) $item_f[0]->render['name'];
                          $code         = (string) $item_f[0]->{header}['statusCode'];
                          $statusMsg    = (string) $item_f[0]->{header}["statusMessage"];
                          $notFoundPath = (string) $item_f[0]->header->render['path'] . ".php";
                          Flight::render(Flight::get("f2x.dir") . $controller);
                          $currentController = new $name;
                          $currentController->init();
                      });
                      break;
                  }
                  $i++;
              }
          } else {
              die("Route File Not Found");
          }
          Flight::start();
      }
  }
?>