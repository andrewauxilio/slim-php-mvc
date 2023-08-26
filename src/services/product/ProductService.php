<?php

namespace app\services\product;

use app\services\DatabaseService;
use Doctrine\DBAL\Exception;

class ProductService
{
    public function __construct(private readonly DatabaseService $databaseService)
    {
    }

    /**
     * @throws Exception
     */
    public function getAll(): array
    {
        return $this->databaseService->getConnection()->fetchAllAssociative('SELECT * FROM products');
    }
}