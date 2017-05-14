<?php

/**
 * Instantiate service containers and assign them to application container
 * @author: Ed Weld <edweld@gmail.com>
 * @package edweld/gousto <https://github.com/edweld/gousto>
 * PHP version 7
 */

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\ServiceLoader;
use App\RoutesLoader;


/**
 * Convert JSON request into standard request object
 */

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

/**
 * Because silex doesn't have functionality for serving OPTIONS request by default, 
 * this service goes through all of your routes and generates the necessary OPTIONS routes
 */
$app->register(new \Euskadi31\Silex\Provider\CorsServiceProvider);


$app->register(new ServiceControllerServiceProvider());
/**
 * Using doctrine to handle DB abstraction
 */
$app->register(new DoctrineServiceProvider(), array(
  "db.options" => $app["db.options"]
));

/**
 * Monlog service for easy log management
 */
$app->register(new MonologServiceProvider(), array(
    "monolog.logfile" => ROOT_PATH . "/logs/" . (new \DateTime('now'))->format("Y-m-d") . ".log",
    "monolog.level" => $app["log.level"],
    "monolog.name" => "application"
));

//load services and bind them to container
$serviceLoader = new App\ServiceLoader($app);
$serviceLoader->bindServicesIntoContainer();

//load routes and bind them to container
$routesLoader = new App\RoutesLoader($app);
$routesLoader->bindRoutesToControllers();


// define Monlog for error handling
$app->error(function (\Exception $e, $code) use ($app) {
    $app['monolog']->addError($e->getMessage());
    $app['monolog']->addError($e->getTraceAsString());
    return new JsonResponse(array("statusCode" => $code, "message" => $e->getMessage(), "stacktrace" => $e->getTraceAsString()));
});

return $app;
