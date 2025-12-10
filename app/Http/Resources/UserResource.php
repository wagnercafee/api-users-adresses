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
            'perfil'  => $this->whenLoaded('profile', function () {
                return [
                    'id'   => $this->profile->id,
                    'name' => $this->profile->name,
                ];
            }),
            'enderecos' => $this->whenLoaded('addresses', function () {
                return $this->addresses->map(function ($address) {
                    return [
                        'id'   => $address->id,
                        'street' => $address->street,
                        'cep'  => $address->cep,
                    ];
                });
            }),
            'created_at' => $this->created_at,
        ];
    }
}
