#What's going on in route.xml?#

"Typical route.xml file"

```xml
<?xml version="1.0" encoding="UTF-8"?>
<routingManager>
   <route path="/">
      <render type="controller" path="/controllers/Main" name="MainController" />
   </route>
   <route path="/test">
      <additional>
         <subroute path="/foo" />
         <subroute path="/bar" />
         <subroute path="/baz/foobar" />
      </additional>
      <render type="controller" path="/controllers/Test" name="TestController" />
   </route>
</routingManager>
```

+ Routes are defined with the &lt;route&gt; tag. To specify the destination, you then create a path attribute with the route you want to specify. **(Please note, this does not differentiate between GET or POST requests. This will be addressed shortly)**
+ Within the <route> element, you must specify a &lt;render&gt; tag, this will tell FlightPHP to load the chosen controller). You must specify attributes for the <render> element. The required attributes are **type, path and name**.
+ For **type** , specify "controller" (without quotes). 
+ For **path** , this is the location of your chosen Controller, without the php extension.
+ For **name** , this is the **class name** of your controller.
+ To specify multiple sub routes , you need to wrap &lt;subroute&gt; tags within an &lt;additional&gt; element which then is contained within &lt;route&gt;. 
  The examples will match: /test/foo , /test/bar , /test/baz/foobar.
+ **Remember, this must be all contained within &lt;routingManager&gt; tags.**
