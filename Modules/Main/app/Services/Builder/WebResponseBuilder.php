<?php

namespace Modules\Main\Services\Builder;

use Closure;
use Illuminate\Support\Collection;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Services\WebResponse;
/**
 * @method static byResult()
 */
class WebResponseBuilder
{
    private WebResponse $webResponse;
    public function __construct()
    {
        $this->webResponse = new WebResponse();
    }

    public function redirect(): WebResponseBuilder
    {
        return $this;
    }
    public function message(string $message): static
    {
        $this->webResponse->setReplyMessage($message);
        return $this;
    }

    public function title(string $title): static
    {
        $this->webResponse->setReplyTitle($title);
        return $this;
    }


    public function type(string $type): static
    {
        $this->webResponse->setReplyType($type);
        return $this;

    }

    public function data(mixed $data): static
    {
        $this->webResponse->setData($data);
        return $this;
    }

    public function route(string|Closure|null $route)
    {
        $this->webResponse->setRoute($route);
        return $this;
    }
    public function successRoute(string|Closure $route)
    {
        $this->webResponse->setSuccessRoute($route);
        return $this;
    }
    public function failedRoute(string|Closure $route)
    {
        $this->webResponse->setFailedRoute($route);
        return $this;
    }
    public function params(mixed $params ): static
    {
        $this->webResponse->setRouteParams($params);
        return $this;
    }

    public function byResult(Collection | ServiceResult $result,string $successRoute = null  ,?string $successMessage=null , $failedRoute = null , ?string $failedMessage=null ,mixed $params=null): static
    {
        if($result->result){
        $this->message($successMessage ?? __('message.admin_success_message'))->type('success')->data($result)->route($successRoute)->params($params);

        }else{
            $this->message($failedMessage ?? __('message.admin_failed_message'))->type('error')->data($result)->route($failedRoute)->params($params);
        }
        return $this;


    }

    public function go(){
        return $this->webResponse->redirect();
    }


}
