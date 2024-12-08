<?php

namespace Modules\Shop\Http\Controllers\Ajax\Admin\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shop\Models\Attribute;

class AttributesController extends Controller
{
    public function get(Request $request, $title)
    {
        $request->validate([
            'title'=>['string'],
        ]);
        $title=$request->get('title');
        $attributes=Attribute::query()->select(['title' ,'id'])->where('title', 'LIKE' , "%$title%");
        $values=$attributes->values()->select(['value','id'])->get();
        return response()->json([
            'message'=>null,
            'result'=>'success',
            'data'=>['attributes'=>$attributes,'values'=>$values],
            'status'=>200
        ])->setStatusCode(200);

    }
}
