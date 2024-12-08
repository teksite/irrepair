<?php

namespace Modules\Shop\Http\Controllers\Web\Admin\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Shop\Http\Logics\AttributeValuesLogic;
use Modules\Shop\Http\Requests\Admin\ValueRequest;
use Modules\Shop\Models\Attribute;
use Modules\Shop\Models\AttributeValue;

class ValuesController extends Controller implements HasMiddleware
{

    public function __construct(public AttributeValuesLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:product-read'),
            new Middleware('can:product-edit', except: ['index']),
        ];
    }

    public function index(Attribute $attribute)
    {
        $values = $this->logic->getAllValues($attribute)->data;
        return view('shop::pages.admin.values.index', compact('attribute','values'));
    }


    public function create(Attribute $attribute)
    {
        return redirect()->action([AttributesController::class, 'index'] ,compact('attribute'));
    }


    public function store(ValueRequest $request ,Attribute $attribute): RedirectResponse
    {
        $result = $this->logic->registerValue($request->validated() , $attribute);
        return WebResponse::byResult($result, 'admin.shop.attributes.values.index')->params($attribute)->go();
    }


    public function show(Attribute $attribute)
    {
        abort(404);
    }


    public function edit(Attribute $attribute)
    {
        return view('shop::pages.admin.values.edit', compact('attribute'));
    }


    public function update(ValueRequest $request, Attribute $attribute , AttributeValue $value): RedirectResponse
    {
        $result = $this->logic->changeValue($request->validated(), $value);
        return WebResponse::redirect()->byResult($result, 'admin.shop.attributes.values.edit')->params($attribute , $value)->go();
    }


    public function destroy(Attribute $attribute , AttributeValue $value)
    {
        $result = $this->logic->destroyValue($value);
        return WebResponse::redirect()->byResult($result, 'admin.shop.attributes.values.index')->go();
    }
}
