<?php

namespace Modules\Comment\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Main\Enums\PublishStatusEnum;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        if (request()->method() == 'POST') {
            return array_merge($this->defaultRules(),
                [
                    'model_type' => 'required|string',
                    'model_id' => 'required|string',
                    'parent_id' => 'required|string',
                ]
            );
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return $this->defaultRules();
        }
        return [
            'nodata' => 'required|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }


    public function authorize(): bool
    {
        if (request()->method() == 'POST') {
            return auth()->check() && auth()->user()->can("comment-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("comment-edit");
        }
        return false;
    }

    public function defaultRules(): array
    {
        return [
            'message' => 'required|string',
            'confirmed' => 'required|in:0,1',
        ];
    }
}
