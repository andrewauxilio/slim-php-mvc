<?php
namespace app\controllers\api;

use app\models\ProductModel;
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
            ->fetchAssociative("SELECT * FROM products WHERE id = ?", [$id]);
    }

//    private function fetchProductsFromDatabase(): array
//    {
//        $query = "SELECT id, name, price FROM products";
//        $result = $this->databaseService->getConnection()->fetchAllAssociative($query);
//
//        $products = [];
//        foreach ($result as $row) {
//            $products[] = new ProductModel(
//                $row['id'],
//                $row['name'],
//                (float) $row['price']
//            );
//        }
//
//        return $products;
//    }
}