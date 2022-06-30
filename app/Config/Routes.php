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
$routes->get('/', 'User::user');
$routes->get('login', 'User_control::login');
$routes->post('check_login','User_control::check_login');
$routes->get('show_user','User_control::show_user');
$routes->get('delete_user/(:segment)','User_control::delete_user/$1');
$routes->match(['get', 'post'], 'insert_user', 'User_control::insert_user');
$routes->get('upload','Upload::index');
$routes->post('upload1','Upload::upload');
$routes->match(['get', 'post'], 'update_user/(:segment)', 'User_control::update_user/$1');
$routes->get('logout','User_control::logout');
//course 
$routes->get('show_course','Course_control::show_course');
$routes->get('delete_course/(:segment)','Course_control::delete_course/$1');
$routes->match(['get', 'post'], 'insert_course', 'Course_control::insert_course');
$routes->match(['get', 'post'], 'update_course/(:segment)', 'Course_control::update_course/$1');
//order
 $routes->get('show_order','Order_control::show_order');
 $routes->get('accept_order/(:segment)','Order_control::accept_order/$1');
 $routes->get('deny_order/(:segment)','Order_control::deny_order/$1');
 $routes->get('add_order/(:segment)','User::add_order/$1');
 $routes->get('history_order/(:segment)','User::history_order/$1');
 //user
 $routes->match(['get', 'post'],'update_user1/(:segment)','User::update_user/$1');
 $routes->get('detail_course/(:segment)','User::detail_course/$1');
 //$routes->get('user','User::user');
 //cart
 $routes->get('cart','User::cart');
 $routes->get('add_cart/(:segment)','User::add_cart/$1');
 $routes->get('delete_cart/(:segment)','User::delete_cart/$1');
 //lesson
 $routes->get('show_lesson','Lesson_control::show_lesson');
 $routes->get('delete_lesson/(:segment)','Lesson_control::delete_lesson/$1');
 $routes->match(['get', 'post'],'update_lesson/(:segment)','Lesson_control::update_lesson/$1');
 $routes->match(['get', 'post'],'insert_lesson','Lesson_control::insert_lesson');
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
