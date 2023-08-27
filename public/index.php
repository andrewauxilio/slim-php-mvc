<?php

global $app;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

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

$errorHandler = function (Request $request, Throwable $exception, bool $displayErrorDetails, bool $logErrors, bool $logErrorDetails) use ($app) {

    // Log the error to the database
    global $container;
    if ($logErrors) {
        // Initialize your database service (DatabaseService in your case)
        $databaseService = $container->get(\app\services\DatabaseService::class);

        // Store the error information in the database
        $errorMessage = $exception->getMessage();
        $errorStackTrace = $exception->getTraceAsString();

        // Insert the error details into your 'logs' table
        $databaseService->getConnection()->insert('logs', [
            'type' => 'ERROR',
            'message' => $errorMessage,
            'context' => $errorStackTrace,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $response = new Response();
        $response->getBody()->write('An error occurred.');

        return $response->withStatus(500);
    }

    // Handle the response as shown in the previous step
};

$errorMiddleware = $app->addErrorMiddleware(true, true, true)
    ->setDefaultErrorHandler($errorHandler);

$app->run();
