<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
//$routes->get('testdb', [App\Controllers\TestDB::class, 'index']);

use App\Controllers\Accueil;
use App\Controllers\Compte;
use App\Controllers\Message;

$routes->get('/', [Accueil::class, 'afficher']);
$routes->get('compte/lister', [Compte::class, 'lister']);


$routes->get('message/suivre', [Message::class, 'suivre']);
$routes->get('message/suivre/(:segment)', [Message::class, 'suivre']);

$routes->get('message/creer', [Message::class, 'creer']);
$routes->post('message/creer', [Message::class, 'creer']);

$routes->get('message/faire_suivre', [Message::class, 'faire_suivre']);
$routes->post('message/faire_suivre', [Message::class, 'faire_suivre']);

$routes->get('compte/creer', [Compte::class, 'creer']);
$routes->post('compte/creer', [Compte::class, 'creer']);


$routes->get('compte/accueil', [Compte::class, 'accueil']);
$routes->get('compte/afficher_profil', [Compte::class, 'afficher_profil']);
$routes->get('compte/deconnecter', [Compte::class, 'deconnecter']);
$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);