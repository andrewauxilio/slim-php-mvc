<?php

namespace app\validations\product;

use app\validations\BaseValidation;
use GuzzleHttp\Psr7\Request;

class ShowProductValidation extends BaseValidation
{
    public function __construct(Request $request)
    {
        $requestData = json_decode($request->getBody()->getContents(), true);

        $this->request = $requestData;
        $this->requestFields = array_keys($requestData);

        $this->validatedFields = [
            'productId' => [
                'required' => true,
                'type' => 'integer'
            ],
        ];
    }
}