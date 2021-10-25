<?php

use App\Common\CommonApp;
use App\Home\HomeApp;
use App\Auth\AuthApp;
use App\Expense\ExpenseApp;

// bootstrap apps

// bootstrap common app
$commonApp = new CommonApp();
$commonApp->bootstrap($app);

$container->set('commonApp', function () use ($commonApp) {
  return $commonApp;
});


// bootstrap auth app
$authApp = new AuthApp();
$authApp->bootstrap($app);

$container->set('authApp', function () use ($authApp) {
  return $authApp;
});

// bootstrap home app
$homeApp = new HomeApp();
$homeApp->bootstrap($app);

$container->set('homeApp', function () use ($homeApp) {
  return $homeApp;
});

// bootstrap expense app
$expenseApp = new ExpenseApp();
$expenseApp->bootstrap($app);

$container->set('expenseApp', function () use ($expenseApp) {
  return $expenseApp;
});
