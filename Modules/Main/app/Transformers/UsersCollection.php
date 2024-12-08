<?php

namespace Modules\Main\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->map(function ($user) {
                return new UserResource($user);
            }),
            'pagination' => $this->paginationInfo()
        ];
    }

    public function paginationInfo()
    {
        $paginated = $this->resource->toArray();
        return [
            'total_items' => $paginated['total'],
            'total_pages' => $paginated['last_page'],
            'per_page' => $paginated['per_page'],
            'current_page' => $paginated['current_page'],
            'prev' => isset($paginated['prev_page_url']),
            'next' => isset($paginated['next_page_url']),
            'path'=>$paginated['path'],
            'query'=>'page'
        ];
    }
}
