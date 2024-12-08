<?php

namespace Modules\Announcement\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Main\Casts\JsonCast;


class AnnouncementUser extends Pivot
{
    protected $table = 'announcement_user';

    protected $fillable = ['announcement_id', 'user_id', 'read_at',];
}


