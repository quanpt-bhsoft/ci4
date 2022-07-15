<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UserControlller');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//user
//$routes->resource('UserController');
$routes->get('/', 'UserHomeController::user');

$routes->get('login', 'UserController::login');
$routes->post('check_login', 'UserController::checkLogin');


$routes->get('detail_course/(:num)', 'UserHomeController::detailCourse/$1');

//cart
$routes->get('cart', 'UserHomeController::cart');
$routes->post('add_cart/(:num)', 'UserHomeController::addCart/$1');
$routes->delete('delete_cart/(:num)', 'UserHomeController::deleteCart/$1');

$routes->group('', ['filter' => 'isLoggedInAdmin'], function ($routes) {
    //user
    $routes->get('showUser', 'UserController::showUser');
    $routes->get('show_insert_user', 'UserController::ShowInsertUser');
    $routes->post('insert_user', 'UserController::insertUser');
    $routes->get('show_update_user/(:num)', 'UserController::showUpdateUser/$1');
    $routes->put('update_user/(:num)', 'UserController::updateUser/$1');
    $routes->delete('delete_user/(:num)', 'UserController::deleteUser/$1');

    //course 
    $routes->get('showCourse', 'CourseController::showCourse');
    $routes->get('show_insert_course', 'CourseController::showInsertCourse');
    $routes->post('insert_course', 'CourseController::insertCourse');
    $routes->get('show_update_course/(:num)', 'CourseController::showUpdateCourse/$1');
    $routes->put('update_course/(:num)', 'CourseController::updateCourse/$1');
    $routes->delete('delete_course/(:num)', 'CourseController::deleteCourse/$1');

    //order
    $routes->get('showOrder', 'OrderController::showOrder');
    $routes->put('accept_order/(:segment)', 'OrderController::acceptOrder/$1');
    $routes->put('deny_order/(:num)', 'OrderController::denyOrder/$1');

    //lesson
    $routes->get('showLesson', 'LessonController::showLesson');
    $routes->get('show_insert_lesson','LessonController::showInsertLesson');
    $routes->post('insert_lesson', 'LessonController::insertLesson');
    $routes->get('show_update_lesson/(:num)','LessonController::showUpdateLesson/$1');
    $routes->put('update_lesson/(:num)', 'LessonController::updateLesson/$1');
    $routes->delete('delete_lesson/(:num)', 'LessonController::deleteLesson/$1');
});
$routes->group('', ['filter' => 'isLoggedIn'], function ($routes) {
    $routes->post('add_order/(:num)', 'UserHomeController::addOrder/$1');
    $routes->get('history_order/(:num)', 'UserHomeController::historyOrder/$1');
    $routes->get('show_update_user1/(:num)','UserHomeController::showUpdateUser/$1');
    $routes->put('update_user1/(:num)', 'UserHomeController::updateUser/$1');
});
$routes->get('logout', 'UserController::logout');
$routes->get('logout1', 'UserHomeController::logout');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
