<?php

namespace Modules\Form\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Main\Casts\JsonCast;

class FormInbox extends Model
{
    use SoftDeletes;

    protected $fillable = ['form_id', 'data', 'url', 'note', 'read_at', 'ip_address','user_id'];

    protected $casts = [
        'data' => JsonCast::class,
        'read_at' => 'timestamp',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class) ??null;
    }
}
