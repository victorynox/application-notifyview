<?php
/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Action\HomePageAction::class, 'home');
 * $app->post('/album', App\Action\AlbumCreateAction::class, 'album.create');
 * $app->put('/album/:id', App\Action\AlbumUpdateAction::class, 'album.put');
 * $app->patch('/album/:id', App\Action\AlbumUpdateAction::class, 'album.patch');
 * $app->delete('/album/:id', App\Action\AlbumDeleteAction::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Action\ContactAction::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

/** @var \Zend\Expressive\Application $app */

//system api path
if ($container->has('api-datastore')) {
    $app->route('/api/datastore[/{resourceName}[/{id}]]', 'api-datastore', ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], 'api-datastore');
}
if ($container->has('webhookActionRender')) {
    $app->route('/webhook[/{resourceName}]', 'webhookActionRender', ['GET', 'POST'], 'webhook');
}




if ($container->has('analyse-analyse-view-page')) {
    $app->route('/analyseAnalyse', 'analyse-analyse-view-page', ['GET'], 'analyse-analyse-view-page');
}

if ($container->has('analyse-search-view-page')) {
    $app->route('/analyseSearch', 'analyse-search-view-page', ['GET'], 'analyse-search-view-page');
}

if ($container->has('listing-analyse-result-view-page')) {
    $app->route('/listingAnalyseResult', 'listing-analyse-result-view-page', ['GET'], 'listing-analyse-result-view-page');
}

if ($container->has('listing-search-result-view-page')) {
    $app->route('/listingSearchResult', 'listing-search-result-view-page', ['GET'], 'listing-search-result-view-page');
}

if ($container->has('buybox-notice-view-page')) {
    $app->route('/buyboxNotice', 'buybox-notice-view-page', ['GET'], 'buybox-notice-view-page');
}

if ($container->has('buybox-status-view-page')) {
    $app->route('/buyboxStatus', 'buybox-status-view-page', ['GET'], 'buybox-status-view-page');
}

if ($container->has('home-page')) {
    $app->route('/', 'home-page', ['GET'], 'home-page');
}
