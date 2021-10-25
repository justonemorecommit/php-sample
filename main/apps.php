<?php

use App\Common\CommonApp;
use App\Home\HomeApp;

// bootstrap apps

// bootstrap common app
$commonApp = new CommonApp();
$commonApp->bootstrap($app);

$container->set('commonApp', function () use ($commonApp) {
  return $commonApp;
});

// bootstrap home app
$homeApp = new HomeApp();
$homeApp->bootstrap($app);

$container->set('homeApp', function () use ($homeApp) {
  return $homeApp;
});
