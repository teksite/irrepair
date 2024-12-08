<?php

namespace Modules\Theme\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class SearchLogic
{
    public function searchModels()
    {
        return app(ServiceWrapper::class)(function () {

            $keyword = request()->s ?? '';

            $items = [];
            if ($keyword == '') return [];

            foreach (config('searchable') as $module) {
                foreach ($module as $item) {

                    if (!isset($item['model']) || !isset($item['name']) || !isset($item['columns'])) continue;
                    if (isset($item['permissions'] ) && count($item['permissions'])){
                        if (!auth()->check()) continue;
                        if (!auth()->user()->canany($item['permissions'])) continue;
                    }

                    $name = $item['name'];
                    $model = $item['model'];
                    $relations =$item['relations'] ?? [];

                    $query = $model::query();

                    if(count(['relations'])) $query=$query->with($relations);


                    $loopIndex = 0;
                    list($query, $loopIndex) = $this->searchInColumns($item['columns'], $loopIndex, $query, $keyword);

                    $this->searchByTags($query , $model, $loopIndex, $keyword);
                    $this->searchByMeta($query , $model, $loopIndex, $keyword);


                    $items['count'][$name] = $query->count();
                    $items['builder'][$name] = $query;

                }
            }
            return $items;
        });
    }

    private function searchByTags($query , $model, int $loopIndex, mixed $keyword): void
    {
        if (method_exists($model, 'tags')) {
            if ($loopIndex == 0) {
                $query->whereHas('tags', function ($query) use ($keyword) {
                    $query->where('title', $keyword);
                });
            } else {
                $query->orWhereHas('tags', function ($query) use ($keyword) {
                    $query->where('title', $keyword);
                });
            }
        }
    }
    private function searchByMeta($query , $model, int $loopIndex, mixed $keyword): void
    {
        if (method_exists($model, 'meta')) {
            if ($loopIndex == 0) {
                $query->whereHas('meta', function ($query) use ($keyword) {
                    $query->whereJsonContains('value', $keyword);
                });
            } else {
                $query->orWhereHas('meta', function ($query) use ($keyword) {
                    $query->whereJsonContains('value', $keyword);
                });
            }
        }
    }

    private function searchInColumns($columns, int $loopIndex, mixed $query, mixed $keyword): array
    {
        foreach ($columns as $column) {
            if ($loopIndex == 0)
                $query = $query->where($column, 'LIKE', "%$keyword%");
            else {
                $query = $query->orWhere($column, 'LIKE', "%$keyword%");
            }
            $loopIndex++;
        }

        return array($query, $loopIndex);
    }

}
