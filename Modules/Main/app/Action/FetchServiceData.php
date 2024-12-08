<?php

namespace Modules\Main\Action;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;

class FetchServiceData
{
    public function __invoke(Model|string|Closure|Relation $model, string|array|Closure|null $searchColumns = null, int $paginating = 20, ?array $relation = null, array $only = ['*'])
    {
        if ($model instanceof Closure && is_callable($model)) return $model();

        if (is_string($model)) return $this->getFromModel($model, $searchColumns, $paginating, $relation, $only);

        if ($model instanceof Relation) return $this->getFromRelation($model, $searchColumns, $paginating);
        dd('sdfsd');
    }


    private function getFromRelation(Relation $model, string|array|Closure|null $searchColumns = null, int $paginating = 20): Collection|LengthAwarePaginator|array
    {
        $query = $model;
        if ($searchColumns) {
            $query = $this->searchInColumns($query, $searchColumns);
            $query = $this->orderingInRelation($query, $model);
        }

        return $this->paginator($paginating, $query);

    }
    private function orderingInRelation(Relation $query): null|Relation
    {
        if ($orderBy = request()->get('order') ?? 'id') {
            $sort = match (request()->get('sort')) {
                'desc' => 'desc',
                default => 'asc'
            };
            if (Schema::hasColumn($query->getQuery()->getModel()->getTable(), $orderBy)) {
                $query = $query ? $query->orderBy($orderBy, $sort) : $query;
            }

        }
        return $query;
    }


    private function getFromModel(Model|string $model, string|array|Closure|null $searchColumns = null, int $paginating = 20, ?array $relation = null, array $only = ['*']): Collection|LengthAwarePaginator|array
    {
        $query = $model::query();
        if ($relation) {
            $rel = $relation[0];
            $relFunc = isset($relation[1]) && is_callable($relation[1]) ? $relation[1] : null;
            $query = $relFunc ? $query->with($rel, $relFunc()) : $query->with($rel);
        }
        if ($searchColumns) {
            $query = $this->searchInColumns($query, $searchColumns);
            $query = $this->orderingInModel($query, $model);
        }
        if ($only[0] != '*') $query->select($only);

        return $this->paginator($paginating, $query);
    }


    private function searchInColumns(Builder|Relation $query, array|Closure|string $searchColumns = 'title'): Builder|Relation
    {
        if ($keyword = request('s')) {
            if (is_string($searchColumns)) {
                $query = $query->where($searchColumns, 'LIKE', "%$keyword%");
            } elseif (is_array($searchColumns)) {

                $loopIndex = 0;
                foreach ($searchColumns as $column) {
                    if (is_string($column)) {
                        if ($loopIndex == 0) {
                            $query = $query->where($column, 'LIKE', "%$keyword%");
                        } else {
                            $query = $query->orWhere($column, 'LIKE', "%$keyword%");
                        }
                        $loopIndex++;
                    } elseif (is_callable($column) && $column instanceof Closure) {
                        $column();
                    }
                }
            } elseif (is_callable($searchColumns) && $searchColumns instanceof Closure) {
                $searchColumns();
            }
        }
        return $query;
    }

    private function orderingInModel(Builder $query, $model): null|Builder
    {
        if ($orderBy = request()->get('order') ?? 'id') {
            $sort = match (request()->get('sort')) {
                'desc' => 'desc',
                default => 'asc'
            };
            if (Schema::hasColumn((new $model)->getTable(), $orderBy)) {
                $query = $query ? $query->orderBy($orderBy, $sort) : $query;
            }

        }
        return $query;
    }

    private function paginator(int $paginating, Relation|Builder $query): array|LengthAwarePaginator|Collection
    {
        if ($paginating >= 0) {
            $paginatingBy = min(request()->get('paginating') ?? 20, 100);
            $query = $query->paginate($paginatingBy);
        } else {
            $query = $query->get();
        }
        return $query;
    }
}
