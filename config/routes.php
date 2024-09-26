<?php
declare(Strict_types=1);

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Api\Test\View\RoutesAction;

$routes = new RouteCollection();
$action = new RoutesAction();
$request = Request::createFromGlobals();

$routes->add('state', new Route('/app/state', ['_controller' => $action->handleState($request)]));
$routes->add('user', new Route('/app/user', ['_controller' => $action->handleUser($request)]));

return $routes;

?>
