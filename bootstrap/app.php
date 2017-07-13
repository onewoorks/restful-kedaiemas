<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';
        
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'yahya',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci']
    ],
    'settings_prod' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'onewoork_kedaiemas',
            'username' => 'onewoork',
            'password' => 'iwang31@lydia26@2013',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci']
    ]
        ]);

$container = $app->getContainer();

//$capsule = new \Illuminate\Database\Capsule\Manager;
//$capsule->addConnection($container['settings']['db']);
//$capsule->setAsGlobal();
//$capsule->bootEloquent();
//
//$container['db'] = function($container) use ($capsule) {
//    return $capsule;
//};

$container['db'] = function ($container) {
    $settings = $container->get('settings')['db'];
    $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['database'], $settings['username'], $settings['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['view'] = function($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
            $container->router, $container->request->getUri()
    ));

    return $view;
};

$container['HomeController'] = function($container) {
    return new \App\Controllers\HomeController($container);
};

$container['KedaiController'] = function($container){
    return new \App\Controllers\KedaiController($container);
};

$container['PermintaanController'] = function($container){
    return new \App\Controllers\PermintaanController($container);
};

$container['PromosiController'] = function($container){
    return new \App\Controllers\PromosiController($container);
};

$container['YahyaController'] = function($container){
    return new \App\Controllers\YahyaController($container);
};

require __DIR__ . '/../app/routes.php';
