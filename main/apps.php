<?php

use App\Home\HomeApp;


// bootstrap common app
$commonApp = new CommonApp();
$commonApp->bootstrap($app);

$container->set('commonApp', function () use ($commonApp) {
  return $commonApp;
});
});
