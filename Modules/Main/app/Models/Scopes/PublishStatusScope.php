<?php

namespace Modules\Main\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;
use Modules\Main\Enums\PublishStatusEnum;

class PublishStatusScope implements Scope
{

    public function apply(Builder $builder, Model $model): void
    {
        $table = $model->getTable();
        $hasPublishedAtColumn = Schema::hasColumn($table, 'published_at');
        if (!request()->routeIs('admin.*') || !auth()->check() || !auth()->user()->can('admin')) {
            $builder->where(function (Builder $builder) {
                $builder->where('status', PublishStatusEnum::Published);
            })->orWhere(function (Builder $builder) use ($hasPublishedAtColumn) {
                $builder->where('status', PublishStatusEnum::Postpone)->when($hasPublishedAtColumn, function (Builder $query) {
                    $query->where('published_at', '<=', now());
                });
            });
        }
    }
}
