<?php
namespace app\controllers\api;

use app\services\DatabaseService;
use Doctrine\DBAL\Exception;

class ProductController
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

    /**
     * @throws Exception
     */
    public function getById(int $id = 1): array
    {
        return $this->databaseService
            ->getConnection()
            ->fetchAssociative('SELECT * FROM products WHERE id = ?', [$id]);
    }
}