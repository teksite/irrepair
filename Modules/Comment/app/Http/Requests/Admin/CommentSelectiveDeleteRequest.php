<?php

namespace Modules\Comment\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CommentSelectiveDeleteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'comments'=>'required|string'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can("comment-delete");
    }
}
