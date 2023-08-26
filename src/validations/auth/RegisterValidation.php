<?php

namespace app\validations\auth;

use app\validations\BaseValidation;
use GuzzleHttp\Psr7\Request;

class RegisterValidation extends BaseValidation
{
    public function __construct(Request $request)
    {
        $requestData = json_decode($request->getBody()->getContents(), true);

        $this->request = $requestData;
        $this->requestFields = array_keys($requestData);

        $this->validatedFields = [
            'firstName' => [
                'required' => true,
                'type' => 'string'
            ],
            'lastName' => [
                'required' => true,
                'type' => 'string'
            ],
            'birthDate' => [
                'required' => true,
                'type' => 'string'
            ],
            'email' => [
                'required' => true,
                'type' => 'string'
            ],
            'password' => [
                'required' => true,
                'type' => 'string'
            ],
            'passwordConfirmation' => [
                'required' => true,
                'type' => 'string'
            ],
        ];
    }
}