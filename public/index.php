<?php

global $app;

require __DIR__ . '/../vendor/autoload.php';

/* Require Config */
require __DIR__ . '/../config/bootstrap.php';

/* Require Environment Variables */
require __DIR__ . '/../.env.local.php';

/* Require DI Container */
require __DIR__ . '/../config/dependency-injection.php';

/* Require Routes */
require __DIR__ . '/../src/routes/routes.php';

/* Require Middlewares */
require __DIR__ . '/../src/middlewares/middlewares.php';

$app->run();
