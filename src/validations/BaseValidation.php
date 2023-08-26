<?php

namespace app\validations;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\MessageInterface;

class BaseValidation
{
    protected array $fields;
    protected array $request;
    protected array $requestFields;

    public function validate(): array|MessageInterface
    {
        $failedValidations = [];
        foreach ($this->requestFields as $requestField) {
            if (!array_key_exists($requestField, $this->fields)) {
               $failedValidations[] = $requestField;
            }
        }

        if (count($failedValidations) > 0) {
            return $this->fail('Missing required fields: ' . implode(', ', $failedValidations));
        } else {
            return $this->success();
        }
    }

    public function success(): array
    {
        return $this->request;
    }

    public function fail(string $message): MessageInterface
    {
        $responseBody = ['message' => $message];
        $response = new Response(401, [], json_encode($responseBody));

        return $response->withHeader('Content-Type', 'application/json');
    }
}