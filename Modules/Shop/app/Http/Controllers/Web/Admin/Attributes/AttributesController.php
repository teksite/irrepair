<?php

namespace Modules\Shop\Http\Controllers\Web\Admin\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Shop\Http\Logics\AttributesLogic;
use Modules\Shop\Http\Requests\Admin\AttributeRequest;
use Modules\Shop\Models\Attribute;

class AttributesController extends Controller implements HasMiddleware
{

    public function __construct(public AttributesLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:product-read'),
            new Middleware('can:product-edit', except: ['index']),
        ];
    }

    public function index()
    {
        $attributes = $this->logic->getAllAttributes()->data;
        return view('shop::pages.admin.attributes.index', compact('attributes'));
    }


    public function create()
    {
        return redirect()->action([AttributesController::class, 'index']);
    }


    public function store(AttributeRequest $request): RedirectResponse
    {
        $result = $this->logic->registerAttribute($request->validated());
        return WebResponse::byResult($result, 'admin.shop.attributes.index')->go();
    }


    public function show(Attribute $attribute)
    {
        abort(404);
    }


    public function edit(Attribute $attribute)
    {
        return view('shop::pages.admin.attributes.edit', compact('attribute'));
    }


    public function update(AttributeRequest $request, Attribute $attribute): RedirectResponse
    {
        $result = $this->logic->changeAttribute($request->validated(), $attribute);
        return WebResponse::redirect()->byResult($result, 'admin.shop.attributes.edit')->params($result->data)->go();
    }


    public function destroy(Attribute $attribute)
    {
        $result = $this->logic->destroyAttribute($attribute);
        return WebResponse::redirect()->byResult($result, 'admin.shop.attributes.index')->go();
    }
}
