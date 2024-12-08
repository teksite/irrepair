<?php

namespace Modules\Shop\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Shop\Models\Product;


class ProductsLogic
{
     use HasTrash;
     const model = Product::class;

    public function getAllProducts()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Product::class ,['title' ,'status' , 'created_at']);
        });
    }

    public function registerProduct(array $inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {

            $product = Product::query()->create(Arr::except($inputs,['tags','seo' ,'attributes']));
            $product->saveTags($inputs['tags'] ?? null);
            $product->saveSeo($inputs['seo']  ?? []);
            $this->syncAttributes($product, $inputs['attributes']);

            return $product;

        });
    }

    public function changeProduct(array $inputs, Product $product)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $product) {

            $product->update($inputs);

            $this->syncAttributes($product, $inputs['attributes']);

            $product->setMeta($inputs['extra'] ?? []);
            $product->saveTags($inputs['tags'] ?? null);
            $product->saveSeo($inputs['seo']  ?? []);
            return $product;
        });
    }

    public function destroyProduct(Product $product)
    {
        return app(ServiceWrapper::class)(fn()=>$product->delete());
    }


    private function syncAttributes(Product $product , array $attributes){

       $syncData = [];
       $detachAttributes = [];

       foreach ($attributes as $attrId => $values) {
           $values = array_filter($values); // Remove null/false/empty values
           if (!empty($values)) {
               foreach ($values as $value) {
                   $syncData[$attrId] = ['value_id' => $value];
               }
           } else {
               $detachAttributes[] = $attrId;
           }
       }

       if (!empty($syncData)) {
           $product->productAttributes()->sync($syncData, false); // Add attributes without detaching others
       }

       if (!empty($detachAttributes)) {
           $product->productAttributes()->detach($detachAttributes);
       }
    }

}
