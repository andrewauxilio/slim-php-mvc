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
}