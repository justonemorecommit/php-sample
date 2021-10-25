<?php

use App\Home\HomeApp;

$container->set('homeApp', function() {
  return new HomeApp();
});
