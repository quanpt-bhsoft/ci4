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
$routes->setDefaultController('User_control');
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
$routes->resource('UserController');
$routes->get('/', 'UserHomeController::user');

$routes->get('login', 'UserController::login');
$routes->post('check_login', 'UserController::checkLogin');

$routes->get('detail_course/(:segment)', 'UserHomeController::detailCourse/$1');
//cart
$routes->get('cart', 'UserHomeController::cart');
$routes->get('add_cart/(:segment)', 'UserHomeController::addCart/$1');
$routes->get('delete_cart/(:segment)', 'UserHomeController::deleteCart/$1');

$routes->group('', ['filter' => 'isLoggedInAdmin'], function ($routes) {
    $routes->get('showUser', 'UserController::showUser');
    $routes->get('showCourse', 'CourseController::showCourse');
    //user
    $routes->get('delete_user/(:segment)', 'UserController::deleteUser/$1');
    $routes->match(['get', 'post'], 'insert_user', 'UserController::insertUser');
    $routes->get('show_insert_user', 'UserController::ShowInsertUser');
    $routes->match(['get', 'post'], 'update_user/(:segment)', 'UserController::updateUser/$1');

    //course 

    $routes->get('delete_course/(:segment)', 'CourseController::deleteCourse/$1');
    $routes->get('show_insert_course', 'CourseController::showInsertCourse');
    $routes->match(['get', 'post'], 'insert_course', 'CourseController::insertCourse');
    $routes->match(['get', 'post'], 'update_course/(:segment)', 'CourseController::updateCourse/$1');
    //order
    $routes->get('showOrder', 'OrderController::showOrder');
    $routes->get('accept_order/(:segment)', 'OrderController::acceptOrder/$1');
    $routes->get('deny_order/(:segment)', 'OrderController::denyOrder/$1');
    //lesson
    $routes->get('showLesson', 'LessonController::showLesson');
    $routes->get('delete_lesson/(:segment)', 'LessonController::deleteLesson/$1');
    $routes->match(['get', 'post'], 'update_lesson/(:segment)', 'LessonController::updateLesson/$1');
    $routes->match(['get', 'post'], 'insert_lesson', 'LessonController::insertLesson');
});
$routes->group('', ['filter' => 'isLoggedIn'], function ($routes) {
    $routes->get('add_order/(:segment)', 'UserHomeController::addOrder/$1');
    $routes->get('history_order/(:segment)', 'UserHomeController::historyOrder/$1');
    $routes->match(['get', 'post'], 'update_user1/(:segment)', 'UserHomeController::updateUser/$1');
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
