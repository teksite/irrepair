<?php
namespace Modules\Main\Services\Facade;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use Modules\Main\Action\ServiceResult;

/**
 * @method routeParams(mixed $params)
 * @method toRoute(string $route)
 * @method static redirect()
 * @method static byResult(Collection | ServiceResult $result ,$successRoute = null , $failedRoute = null , ?string $successMessage = null , ?string $failedMessage = null)
 */
class WebResponse extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'WebResponse';
    }

}
