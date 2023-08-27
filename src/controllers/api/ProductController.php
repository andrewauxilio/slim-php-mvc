<?php
namespace app\controllers\api;

use app\controllers\BaseAPIController;
use app\DTOs\product\ShowProductRequestDTO;
use app\services\product\ProductService;
use app\validations\product\ShowProductValidation;
use Exception;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\MessageInterface;

class ProductController extends BaseAPIController
{
    public function __construct(private readonly ProductService $productService)
    {
        parent::__construct();
    }

    public function index(Request $request, Response $response, array $args): Response|MessageInterface
    {
        try {
            return $this->apiSuccess($response, $this->productService->getAll());
        } catch (Exception $exception) {
            return $this->apiError($response, $exception->getMessage());
        }
    }

    public function show(Request $request, Response $response, array $args): MessageInterface
    {
        try {
            $showProductValidation = new ShowProductValidation($request);
            $showProductRequestDTO = new ShowProductRequestDTO($showProductValidation->validate());

            return $this->apiSuccess($response, $this->productService->getById($showProductRequestDTO));
        } catch (Exception $exception) {
            return $this->apiError($response, $exception->getMessage());
        }
    }
}