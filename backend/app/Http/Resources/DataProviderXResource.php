<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataProviderXResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->parentIdentification,
            'currency' => $this->Currency,
            'balance' => $this->parentAmount,
            'email' => $this->parentEmail,
            'statusCode' => $this->string_status,
            'created_at' => $this->registerationDate,
            'provider' => $this->provider_name,
        ];
    }
}
