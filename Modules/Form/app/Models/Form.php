<?php

namespace Modules\Form\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Main\Casts\JsonCast;

// use Modules\Form\Database\Factories\FormFactory;

class Form extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'body', 'emails', 'phones', 'telegram_id', 'urls','template','rules','has_file','recaptcha'];

    protected $casts = [
        'emails' => JsonCast::class,
        'phones' => JsonCast::class,
        'telegram_id' => JsonCast::class,
        'urls' => JsonCast::class,
        'rules' => JsonCast::class,
    ];

    public function inboxes()
    {
        return $this->hasMany(FormInbox::class);
    }
}
