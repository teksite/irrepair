<?php
namespace Modules\Main\Services\Facade;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use Modules\Main\Action\ServiceResult;

/**
 * @method static response()
 */
class ApiResponse extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ApiResponse';
    }

}
