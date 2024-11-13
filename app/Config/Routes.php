<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'SeatAllocationController::index');
$routes->post('/allocate-seat', 'SeatAllocationController::allocateSeat');
$routes->post('/clear-all-seats', 'SeatAllocationController::clearAllSeats');
