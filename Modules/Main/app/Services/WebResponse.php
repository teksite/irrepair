<?php

namespace Modules\Main\Services;

use Closure;
use Illuminate\Support\Collection;
use Modules\Main\Action\ServiceResult;

class WebResponse
{
    private ?string $title = null;
    private ?string $message = null;
    private string $type = 'success';
    private mixed $data = null;
    private string|null $successRoute = null;
    private string|null $failedRoute = null;
    private mixed $params = null;
    private string|Closure|null $route = null;
    private bool $result = true;


    public function setReplyTitle(string $title): void
    {
        $this->title = $title;
    }
    public function setReplyMessage(string $message): void
    {
        $this->message = $message;
    }
    public function setReplyType(string $type): void
    {
        $this->type = $type;
    }
    public function setData(mixed $data): void
    {
        $this->data = $data;
    }
    public function setRouteParams(mixed $params = null): void
    {
        $this->params = $params;
    }
    public function setSuccessRoute(mixed $route = null): void
    {
        $this->successRoute = $route;
    }
    public function setFailedRoute(mixed $route = null): void
    {
        $this->failedRoute = $route;
    }
    public function setRoute(mixed $route = null): void
    {
        $this->route = $route;
    }
    public function redirect()
    {
        $with = [];
        !is_null($this->title) && $with['title'] = $this->title;
        !is_null($this->message) && $with['message'] = $this->message;
        !is_null($this->type) && $with['type'] = $this->type;

        !is_null($this->data) && $with['data'] = $this->data;

        if ($this->result) {
            $redirect =$this->successRoute || $this->route ? redirect()->route($this->successRoute ?? $this->route , $this->params) : back();
        } else {
            $redirect = $this->failedRoute || $this->route ? redirect()->route($this->failedRoute ?? $this->route , $this->params) : back();
        }

        return count($with) ? $redirect->with(['reply' => $with]) : $redirect;
    }
}
