<?php

namespace App\Model;

class Pokemon
{
    private string $name;
    private int $height;
    private int $weight;
    private string $imageUrl;
    private array $abilities;

    public function __construct(
        string $name,
        int $height,
        int $weight,
        string $imageUrl,
        array $abilities
    )
    {
        $this->name = $name;
        $this->height = $height;
        $this->weight = $weight;
        $this->imageUrl = $imageUrl;
        $this->abilities = $abilities;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getHeight() : int
    {
        return $this->height;
    }

    public function getWeight() : int
    {
        return $this->weight;
    }

    public function getImageUrl() : string
    {
        return $this->imageUrl;
    }

    public function getAbilities() : array
    {
        return $this->abilities;
    }
}