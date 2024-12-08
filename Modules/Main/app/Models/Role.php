<?php

namespace Modules\Main\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Academy\Models\Course;
use Modules\Academy\Models\CourseGroup;

class Role extends Model
{


    protected $fillable = ['title','description','hierarchy'];

    public function users()
    {
        return $this->morphToMany(User::class,'authorization' , 'user_authorizations');

    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }



    public function Courses()
    {
        return $this->belongsToMany(Course::class);
    }
    public function courseGroups()
    {
        return $this->belongsToMany(CourseGroup::class ,'course_group_role' , relatedPivotKey:'group_id');
    }
    public function relatedCourses()
    {
        return $this->belongsToMany(Course::class,);
    }
}
