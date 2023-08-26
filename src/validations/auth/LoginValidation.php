<?php

namespace app\validations\auth;

use app\validations\BaseValidation;
use GuzzleHttp\Psr7\Request;

class LoginValidation extends BaseValidation
{
    public function __construct(Request $request)
    {
        $requestData = json_decode($request->getBody()->getContents(), true);

        $this->request = $requestData;
        $this->requestFields = array_keys($requestData);

        $this->fields = [
            'email' => [
                'required' => true,
                'type' => 'string'
            ],
            'password' => [
                'required' => true,
                'type' => 'string'
            ],
        ];
    }
}