<?php

namespace Modules\Main\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class OneTimePassword extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'code', 'key','expired_at'];

    protected $casts = [
        //'code' => 'integer',
        //'expired_at'=>'timestamp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
