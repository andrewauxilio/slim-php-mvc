<?php
namespace app\controllers\api;

use app\controllers\BaseAPIController;
use app\services\product\ProductService;
use Doctrine\DBAL\Exception;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\MessageInterface;

class ProductController extends BaseAPIController
{
    public function __construct(private readonly ProductService $productService)
    {
        parent::__construct();
    }

    public function getAll(Response $response): Response|MessageInterface
    {
        try {
            return $this->apiSuccess($response, $this->productService->getAll());
        } catch (Exception $exception) {
            return $this->apiError($response, $exception->getMessage());
        }
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