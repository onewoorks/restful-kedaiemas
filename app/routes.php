<?php

$app->get('/', 'HomeController:index');

$app->get('/kedai', 'KedaiController:getSenaraiKedai');
$app->get('/kedai/[{id}]', 'KedaiController:getKedaiById');

$app->post('/permintaan', 'PermintaanController:postPermintaan');

$app->get('/promosi', 'PromosiController:getSenaraiPromosi');