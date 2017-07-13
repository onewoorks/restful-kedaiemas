<?php

$app->get('/', 'HomeController:index');

$app->get('/kedai', 'KedaiController:getSenaraiKedai');
$app->get('/kedai/[{id}]', 'KedaiController:getKedaiById');

$app->post('/permintaan', 'PermintaanController:postPermintaan');
$app->post('/permintaan/image', 'PermintaanController:postImage');
$app->get('/permintaan/senarai', 'PermintaanController:senaraiPermintaan');

$app->get('/promosi', 'PromosiController:getSenaraiPromosi');
$app->get('/promosi/layer/[{layer}]', 'PromosiController:getSenaraiPromosiLayer');

$app->get('/yahyasample', 'YahyaController:getSampleData');
$app->post('/yahyasample/image', 'YahyaController:postImage');