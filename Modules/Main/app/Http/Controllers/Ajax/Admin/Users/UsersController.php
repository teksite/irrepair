<?php

namespace Modules\Main\Http\Controllers\Ajax\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function get(Request $request)
    {

        $request->validate([
            'title'=>['string','required'],
        ]);

        $keyword=$request->title;

        $users=User::query()->where('name','LIKE',"%$keyword%")
            ->orWhere('email','LIKE',"%$keyword%")
            ->orWhere('phone','LIKE',"%$keyword%")->get(['name','id'])->toArray();
        return response()->json([
            'message'=>null,
            'result'=>'success',
            'data'=>$users,
            'status'=>200
        ])->setStatusCode(200);

    }
}
