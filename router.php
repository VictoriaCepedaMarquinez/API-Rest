<?php
require_once 'libs/route.php';
require_once 'app/controllers/room.api.controller.php';
require_once 'app/controllers/user.api.controller.php';

$router = new Router();

$router->addRoute('rooms/:ID',       'PUT', 'RoomApiController',      'update');
$router->addRoute('rooms/:ID',       'GET', 'RoomApiController',      'get');
$router->addRoute('rooms',           'GET', 'RoomApiController',      'get');
$router->addRoute('rooms',           'POST','RoomApiController',      'create');
$router->addRoute('rooms/:ID',           'DELETE','RoomApiController',      'delete');
$router->addRoute('room',            'GET', 'RoomApiController',      'filterRooms');
$router->addRoute('user/token',      'GET', 'UserApiController',      'getToken');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);