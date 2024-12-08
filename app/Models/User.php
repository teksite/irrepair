<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Modules\Academy\Models\Course;
use Modules\Academy\Models\CourseGroup;
use Modules\Academy\Models\Episode;
use Modules\Academy\Models\EpisodeView;
use Modules\Announcement\Models\Announcement;
use Modules\Comment\Models\Comment;
use Modules\Main\Models\OneTimePassword;
use Modules\Main\Models\Permission;
use Modules\Main\Models\Role;
use Modules\Main\Models\UserMeta;
use Modules\Main\Traits\Meta\HasMeta;
use Modules\Shop\Models\Cart;
use Modules\Shop\Models\Order;
use Modules\Shop\Models\Product;

class User extends Authenticatable implements MustVerifyEmail
{

    use HasFactory, Notifiable, TwoFactorAuthenticatable;


    protected $fillable = ['parent_id', 'username', 'slug', 'code_meli', 'name', 'nickname', 'email', 'phone', 'telegram_id', 'featured_image', 'password',];


    protected $hidden = [
        'password',
        'remember_token',
        "two_factor_secret",
        "two_factor_recovery_codes",
        "two_factor_confirmed_at",
        'code_meli',
        'telegram_id',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function path()
    {
        if (Route::has('users.show')) {
            return route('users.show', $this->slug);
        } else {
            return null;
        }

    }
    public function roles(): MorphToMany
    {
        return $this->morphedByMany(Role::class, 'authorization', 'user_authorizations');
    }
    public function permissions(): MorphToMany
    {
        return $this->morphedByMany(Permission::class, 'authorization', 'user_authorizations');
    }
    public function hasRole(string|array|Role|Collection $roles): bool
    {
        if (is_string($roles)) {
            $roles = collect($roles);
        }
        return !!$roles->intersect($this->roles)->all();
    }
    public function hasPermission(string|Permission $permission): bool
    {
        if (is_string($permission)) {
            $permission = Permission::firstWhere('title', $permission);
        }
        return $this->permissions->contains('title', $permission->title) || $this->hasRole($permission->roles);
    }

    public function meta()
    {
        return $this->hasMany(UserMeta::class);
    }
    public function getMeta(string $key , $column = 'value')
    {
        return  $this->meta()->firstWhere('key', $key)?->$column ?? [];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function oneTimePasswords()
    {
        return $this->hasMany(OneTimePassword::class);
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement   ::class )->withPivot('read_at');
    }


    public function cart()
    {
        return $this->hasOne(Cart::class)->withCount('products');
    }
    public function hasCart()
    {
        return $this->cart()->exists();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isInCart(Product $product)
    {
       return $this->cart?->products->contains($product);
    }



}
