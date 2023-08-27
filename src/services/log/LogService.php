<?php

namespace app\services\log;

use app\services\DatabaseService;

class LogService
{
    public function __construct(DatabaseService $databaseService)
    {
    }

    public function log(string $type, string $message): void
    {
        // TODO insert to DB

        // TODO log to file
    }
}