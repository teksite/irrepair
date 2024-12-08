<?php

namespace Modules\Comment\Http\Requests\Client;

use Modules\Main\Action\ApiRequest;

class LoadMoreCommentApiRequest extends ApiRequest
{

    public function rules(): array
    {
        return [
            'page' => 'required|integer|min:0',
            'commentable_type'=>'required',
            'commentable_id'=>'required',
        ];
    }

    public function authorize(): bool
    {
        return $this->ajax();
    }
}
