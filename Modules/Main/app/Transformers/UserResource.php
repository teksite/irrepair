<?php

namespace Modules\Main\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'roles'=>$this->roles->pluck('title')->toArray(),
            'permissions'=>$this->permissions->pluck('title')->toArray()
        ];
    }
}
