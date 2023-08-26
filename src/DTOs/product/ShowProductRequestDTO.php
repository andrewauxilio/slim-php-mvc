<?php

namespace app\DTOs\product;

class ShowProductRequestDTO
{
    public function __construct(private readonly array $data)
    {
    }

    public function productId(): string
    {
        return $this->data['productId'];
    }
}