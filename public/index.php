<?php

global $app;

use Psr\Log\LoggerInterface;

require __DIR__ . '/../vendor/autoload.php';

/* Require Config */
require __DIR__ . '/../config/bootstrap.php';

/* Require Environment Variables */
require __DIR__ . '/../.env.local.php';

/* Require DI Container */
require __DIR__ . '/../config/DI.php';

/* Require Routes */
require __DIR__ . '/../src/routes/api/ProductRoutes.php';
require __DIR__ . '/../src/routes/api/AuthRoutes.php';
require __DIR__ . '/../src/routes/admin/WebRoutes.php';

/**
 * Add Error Middleware
 *
 * @param bool                  $displayErrorDetails -> Should be set to false in production
 * @param bool                  $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool                  $logErrorDetails -> Display error details in error log
 * @param LoggerInterface|null  $logger -> Optional PSR-3 Logger
 *
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->run();
