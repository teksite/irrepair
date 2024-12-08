<?php

namespace Modules\Widget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','body' ,'label'];

    public function scopeGetTheWidget($query , string $label)
    {
        return $query->firstWhere('label' ,$label) ? $query->firstWhere('label' ,$label)->body : null;
    }
}
