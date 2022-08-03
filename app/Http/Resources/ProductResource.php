<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => $this->type,
            'description' => $this->description,
            'price' => $this->price,
        ];
    }
}
