<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            // 'perfil' => $this->type,
            // 'data_cadastro' => $this->created_at,
            // 'enderecos' => AddressResource::collection($this->whenLoaded('addresses')),
        ];
    }
}
