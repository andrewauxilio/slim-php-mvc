<?php

namespace app\models;

class ProductModel
{
    public const TABLE_NAME = 'products';

    public function __construct(
        private int $id,
        private string $name,
        private float $price)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ProductModel
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ProductModel
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): ProductModel
    {
        $this->price = $price;
        return $this;
    }
}