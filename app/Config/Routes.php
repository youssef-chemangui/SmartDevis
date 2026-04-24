<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
//$routes->get('testdb', [App\Controllers\TestDB::class, 'index']);

use App\Controllers\Accueil;
use App\Controllers\Compte;

$routes->get('/', [Accueil::class, 'afficher']);
$routes->get('compte/lister', [Compte::class, 'lister']);