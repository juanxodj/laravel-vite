<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashRegisterResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'description' => $this->description,
            'user_id' => $this->user_id,
            'details' => $this->details,
        ];
    }
}
