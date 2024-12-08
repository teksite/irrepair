<?php

namespace Modules\Main\Http\Controllers\Ajax\Admin\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Main\Models\Role;

class RolesController extends Controller
{
    public function get(Request $request)
    {

        $request->validate([
            'title'=>['string','required'],
        ]);

        $keyword=$request->title;
        $roles=Role::query()->where('title','LIKE',"%$keyword%")->get();
        return response()->json([
            'message'=>null,
            'result'=>'success',
            'data'=>$roles,
            'status'=>200
        ])->setStatusCode(200);

    }
}
