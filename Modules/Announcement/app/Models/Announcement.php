<?php

namespace Modules\Announcement\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Main\Casts\JsonCast;


class Announcement extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','message','creator_id','pinned' ,'info'];

    protected function casts(): array
    {
        return [
            'info' => JsonCast::class,
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class ,'creator_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class )->withPivot('read_at');
    }

    public function user(User|int|null $user=null)
    {
        if($user instanceof  User){
            $userId=$user->id;
        }elseif(is_int($user)){
            $userId=$user;
        }else {
            $userId=auth()->id();
        }
        return $this->users()->where('user_id',$userId)->first();
    }
}


