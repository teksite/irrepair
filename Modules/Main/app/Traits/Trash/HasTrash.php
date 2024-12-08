<?php

namespace Modules\Main\Traits\Trash;

use Modules\Main\Action\ServiceWrapper;

trait HasTrash
{

    public function trashesCount()
    {
        return app(ServiceWrapper::class)(fn() => self::model::onlyTrashed()->count());
    }

    public function getAllTrashes()
    {
        return app(ServiceWrapper::class)(fn() => self::model::onlyTrashed()->paginate(20));
    }

    public function restoreOne(int $id)
    {
        return app(ServiceWrapper::class)(fn() => self::model::onlyTrashed()->find($id)->restore());
    }

    public function restoreAll()
    {
        return app(ServiceWrapper::class)(fn() => self::model::onlyTrashed()->restore());
    }


    public function deleteOne(int $id)
    {
        $instance = self::model::onlyTrashed()->find($id);
        return app(ServiceWrapper::class)(function () use ($instance, $id) {
            if (method_exists(self::model, 'comments')) $instance->comments()->forcedelete();
            if (method_exists(self::model, 'tags')) $instance->tags()->detach();
            if (method_exists(self::model, 'categories')) $instance->categories()->detach();
            self::model::onlyTrashed()->find($id)->forceDelete();
        }
        );
    }

    public function deleteAll()
    {
        return app(ServiceWrapper::class)(function () {
            self::model::onlyTrashed()->forceDelete();
        });
    }
}
