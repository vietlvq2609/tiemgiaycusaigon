<?php
  declare(strict_types=1);
  include_once('./config/Database.php');
  // include_once('./config/routes.php');
  require('./vendor/autoload.php');
  spl_autoload_register(function ($class) : void {
    $filename = __DIR__ . "/models/$class.php"; 
    if (is_readable($filename)) {
      include_once($filename);
    }
  });
  spl_autoload_register(function ($class) : void {
    $filename = __DIR__ . "/controllers/$class.php"; 
    if (is_readable($filename)) {
      include_once($filename);
    }
  });

  header('Content-Type: application/json; charset=UTF-8'); 

  $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/users', 'UserController@index');
    $route->addRoute('POST', '/users', 'UserController@create');
    $route->addRoute('GET', '/users/{id:\d+}', 'UserController@show');
    $route->addRoute('GET', '/addresses', 'AddressController@index');
  });

  // Fetch method and URI from somewhere
  $uri = str_replace('/tiemgiaycusaigon/server', '', $_SERVER["REQUEST_URI"]);
  $httpMethod = $_SERVER["REQUEST_METHOD"];

  // Strip query string (?foo=bar) and decode URI
  if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
  }

  $uri = rawurldecode($uri);
  $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
  $db = new Database('localhost', 'tiemgiaycusaigon', 'root', '');

  switch ($routeInfo[0]) {
      case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        echo json_encode(array('message' => "404 Not Found"));
        break;
      case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        echo json_encode(array(
          'message' => " 405 Method Not Allowed",
          'allowed_methods' => $allowedMethods
        ));

        break;
      case FastRoute\Dispatcher::FOUND:
        $handler = explode('@', $routeInfo[1]);
        $controllerName = $handler[0];
        $action = $handler[1];
        $vars = $routeInfo[2];
        $controller = new $controllerName($db);
        if (!empty($vars)) {
          $controller->$action($vars);
        } else {
          $controller->$action();
        }
        break;
  }
?>