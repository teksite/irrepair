<?php

namespace Modules\Main\Services\Builder;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Services\ApiResponse;
use Modules\Main\Services\WebResponse;

class ApiResponseBuilder
{
    private ApiResponse $apiResponse;
    public function __construct()
    {
        $this->apiResponse = new ApiResponse();
    }

    public function response(): ApiResponseBuilder
    {
        return $this;
    }
    public function message(array|string $message): static
    {
        $this->apiResponse->setMessage($message);
        return $this;
    }

    public function statusCode(int $code): static
    {
        $this->apiResponse->setStatus($code);
        return $this;
    }
    public function statusMessage(int $code): static
    {
        $this->apiResponse->setStatusMessage($code);
        return $this;
    }
    public function appendData(mixed $data): static
    {
        $this->apiResponse->setData($data);
        return $this;
    }


    public function byResult(Collection|ServiceResult $result , int $statusCode = null , $failedCode = null ,  string|null $message = null): static
    {
        $this->apiResponse->setResult($result , $statusCode , $failedCode , $message ?? 'success');
        return $this;
    }


    public function reply(): JsonResponse
    {
        return $this->apiResponse->build();
    }


}
