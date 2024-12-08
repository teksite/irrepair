<?php

namespace Modules\Main\Http\Logics;


use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\Role;
use Modules\Main\Traits\Upload\Uploader;

class UsersLogic
{
    use Uploader;
    public function getAllUsers()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(User::class, ['name', 'email', 'phone'] ,relation: ['roles']);
        });
    }

    public function registerUser(array $inputs ,bool $verified=false): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($verified, $inputs) {
            $inputs['username'] = $inputs['username'] ?? 'u' . strtolower(Str::random(1)) . time();
            $inputs['slug'] = $inputs['username'];
            $user = auth()->check() ? auth()->user()->children()->create($inputs) : User::query()->create($inputs);
            $uerRole = Role::query()->firstWhere('title', 'user');
            $user->roles()->attach($uerRole);
            $user->meta()->create([
                'key' => 'max_user_creation',
                'value' => 5,
                'stance' => 'off'
            ]);
            if($verified) $user->markEmailAsVerified();
            return $user;
        });
    }

    public function changeUser(array $inputs, User $user)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $user) {

            if (!isset($inputs['password'])) $inputs = array_diff_key($inputs, ['password' => null]);
            $user->update($inputs);
            if(isset($inputs['permissions']))  $user->permissions()->sync($inputs['permissions']);
            if (isset($inputs['roles'])) $user->roles()->sync($inputs['roles']);
            foreach ($inputs['meta'] ?? [] as $key =>$value){
                $user->meta()->updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
            return $user;
        });
    }

    public function destroyUser(User $user)
    {
        return app(ServiceWrapper::class)(function () use ($user) {
            $user->delete();
        });
    }

    public function changePassword(array $inputs, User $user)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $user) {
            $user->forceFill(['password' => Hash::make($inputs['password'])]);
            Auth::logoutOtherDevices($inputs['password']);
            auth()->logout();
        });
    }


    public function terminateSession(array $inputs, User $user)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $user) {
               Auth::logoutOtherDevices($inputs['password']);
               Auth::logoutCurrentDevice();
        });

    }

    public function fetchUsers($keyword)
    {
        $keyword=$keyword['title'];
        return app(ServiceWrapper::class)(function ()  {
            return app(FetchServiceData::class)(User::class, ['name', 'email', 'phone'] ,paginating:-1 ,only:['id' ,'name','phone','email']);
        });
    }


    public function changeProfile(array $inputs, User $user)
    {

        return app(ServiceWrapper::class)(function () use ($inputs, $user) {
            $url =$this->fileUploader($inputs['featured_image'] ,'users/'.$user->id);
            $inputs['featured_image'] = $url;
            if (!isset($inputs['password'])) $inputs = array_diff_key($inputs, ['password' => null]);
            $user->update($inputs);

            if(isset($inputs['permissions']))  $user->permissions()->sync($inputs['permissions']);
            if (isset($inputs['roles'])) $user->roles()->sync($inputs['roles']);
            foreach ($inputs['meta'] ?? [] as $key =>$value){
                $user->meta()->updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
            return $user;
        });
    }

}
