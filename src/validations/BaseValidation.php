<?php

namespace app\validations;

use app\exceptions\validation\ValidationException;
use Psr\Http\Message\MessageInterface;

class BaseValidation
{
    protected array $validatedFields;
    protected array $request;
    protected array $requestFields;

    /**
     * @throws ValidationException
     */
    public function validate(): array|MessageInterface
    {
        $failedValidations = [];

        // Check if fields are allowed
        foreach ($this->requestFields as $requestField) {
            if (!array_key_exists($requestField, $this->validatedFields)) {
               $failedValidations[] = "Field $requestField is not allowed";
            } else {
                $field = $this->validatedFields[$requestField];
                // Check if field is of the correct type
                if (array_key_exists($requestField, $this->request)) {
                    $fieldType = gettype($this->request[$requestField]);
                    if ($fieldType !== $field['type']) {
                        $failedValidations[] = "Field $requestField must be of type $field[type]";
                    }
                }
            }
        }

        // Check if required fields are present
        foreach ($this->validatedFields as $validatedField => $field) {
            if ($field['required'] && !in_array($validatedField, $this->requestFields)) {
                $failedValidations[] = "Field $validatedField is required";
            }
        }

        // Throw exception if any validations failed
        if (count($failedValidations) > 0) {
            throw new ValidationException($failedValidations);
        }

        return $this->request;
    }
}