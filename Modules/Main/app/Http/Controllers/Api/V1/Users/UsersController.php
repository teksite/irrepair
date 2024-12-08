<?php

namespace Modules\Main\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\Main\Http\Logics\UsersLogic;
use Modules\Main\Http\Requests\Admin\UsersApiRequest;
use Modules\Main\Services\Facade\ApiResponse;
use Modules\Main\Transformers\UserResource;
use Modules\Main\Transformers\UsersCollection;

class UsersController extends Controller
{
    public function __construct(public UsersLogic $logic)
    {

    }

    public function index()
    {
        return apiResponse::response()->appendData((new UsersCollection(User::paginate())))->statusCode(200)->statusMessage(200)->reply();
    }



    public function store(UsersApiRequest $request)
    {
        if(request()->get('token') != '$2y$10$XHmdRIr94RHi0iTwKSQAf.Ih3DmjWZBnv98AI5tCMg82zZbk646bi') abort(422);

        $inputs = array_merge($request->validated() , ['password'=>$request->phone]);
        $result=$this->logic->registerUser($inputs);
        $result->data=new UserResource($result->data);
        return apiResponse::response()->byResult($result)->reply();
    }


    public function show(User $user)
    {
        if(request()->get('token') != '$2y$10$XHmdRIr94RHi0iTwKSQAf.Ih3DmjWZBnv98AI5tCMg82zZbk646bi') abort(422);

        return apiResponse::response()->appendData((new UserResource($user)))->statusCode(200)->statusMessage(200)->reply();
    }


    public function update(UsersApiRequest $request,User $user)
    {
        if(request()->get('token') != '$2y$10$XHmdRIr94RHi0iTwKSQAf.Ih3DmjWZBnv98AI5tCMg82zZbk646bi') abort(422);

        $result=$this->logic->changeUser($user,$request->validated());;
        $result->data=new UserResource($result->data);
        return apiResponse::response()->byResult($result)->reply();
    }


    public function destroy(User $user)
    {
        if(request()->get('token') != '$2y$10$XHmdRIr94RHi0iTwKSQAf.Ih3DmjWZBnv98AI5tCMg82zZbk646bi') abort(422);

        $result=$this->logic->destroyUser($user);;
        return ApiResponse::response()->byResult($result)->reply();
    }
}
