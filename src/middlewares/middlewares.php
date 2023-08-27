<?php

global $app;

use GuzzleHttp\Psr7\Request;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Add Error Middleware
 *
 * @param Request $request
 * @param Throwable $exception
 * @param bool $displayErrorDetails -> Should be set to false in production
 * @param bool $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool $logErrorDetails -> Display error details in error log
 * @throws \Psr\Container\ContainerExceptionInterface
 * @throws NotFoundExceptionInterface
 */
