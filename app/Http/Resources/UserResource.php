<?php

namespace App\Http\Resources;

use App\Domain\Entities\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var User $this */
        return [
            'id' => $this->id,
            'email' => $this->email,
            'gender' => $this->gender,
            'created_at' => $this->created_at,
        ];
    }
}
