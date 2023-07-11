<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/home/test', 'Home::test');
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/login', 'Admin::login');

/* create softsol data form  */
$routes->get('/admin/softsol-data', 'Admin::create_softsol_data');
/* route for post about us page data into database */
$routes->post('admin/insert-softsol-data', 'Admin::insert_softsol_data');

/* show editable softsol data */
$routes->get('admin/softsol-data/edit/(:num)', 'Admin::edit_softsol_data/$1');

/* update editable data */
$routes->post('admin/softsol-data/update', 'Admin::update_softsol_data');

/* about us start */

/* view aboutus data  */
$routes->get('/admin/about-us/(:any)', 'Admin::aboutus/$1');



/* view  services our-services data */
$routes->get('/admin/services/(:any)', 'Admin::services_our_services/$1');


/* about us end  */

/* Show editable create page data */

$routes->get('admin/edit/aboutus/(:num)', 'Admin::editaboutus/$1');

/* Update aboutus  data  */

$routes->post('admin/aboutus/update', 'Admin::update_aboutus');

/* portfolio routes start */

/* show portfolio data */

$routes->get('/admin/portfolio', 'Admin::portfolio');

/* routes for create portfolio data */
$routes->get('/admin/create-portfolio', 'Admin::createportfolio');

/* routes for insert portfolio data admin/portfolio/insert */
$routes->post('admin/portfolio/insert', 'Admin::insert_portfolio');

/* Show editable portfolio page data */

$routes->get('admin/edit/portfolio/(:num)', 'Admin::editportfolio/$1');

/* update portfolio page data */
$routes->post('admin/portfolio/update', 'Admin::update_portfolio');
/* portfolio routes end */








/* Client Routs  */

$routes->get('aboutus', 'Client::aboutus');

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
