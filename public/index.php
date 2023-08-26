<?php

global $app;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/bootstrap.php';
require __DIR__ . '/../.env.local.php';

/* Require Routes */
require __DIR__ . '/../src/routes/api/ProductRoutes.php';
require __DIR__ . '/../src/routes/api/AuthRoutes.php';
require __DIR__ . '/../src/routes/admin/WebRoutes.php';

$app->run();
