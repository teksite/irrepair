<?php

namespace Modules\Announcement\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {

        return [
            'title' => 'required|string',
            'message' => 'required|string',
            'target' => 'required|string|in:users,roles,newsletter',
            'users' => 'required_if:target,users|array',
            'roles' => 'required_if:target,roles|array',
            'roles.*' => 'required_if:target,roles',
            'users.*' => 'required_if:target,users',
            'pinned' => 'sometimes',
            'routes' => 'required_if:target,users|required_if:target,roles|array',
            'routes.*'=> 'in:site,email,sms,telegram',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('announcement-create');
    }
}
