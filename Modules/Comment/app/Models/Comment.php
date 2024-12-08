<?php

namespace Modules\Comment\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;


class Comment extends Model
{
    use SoftDeletes ,HasRecursiveRelationships;

    protected $fillable = ['user_id', 'parent_id', 'model_id', 'model_type', 'message', 'confirmed','name','email' ,'ip_address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function model()
    {
        return $this->morphTo('model');
    }

}
