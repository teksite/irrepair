<?php

namespace Modules\Main\Services;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Modules\Main\Action\ServiceResult;

class ApiResponse
{
    private array $message = [];
    private int $statusCode = 200;
    private ?string $statusMessage = null;
    private mixed $data = null;


    public function setMessage(array|string $message): void
    {
        $this->message[] = is_array($message) ? array_push($this->message, ...$message) : $message;
    }

    public function setStatus(int $code): void
    {
        $this->statusCode = $code;
    }

    public function setStatusMessage(?int $code): void
    {
        $code = $code ?? $this->statusCode;
        $this->statusMessage = serverResponseMessage($code);
    }

    public function setData(mixed $data): void
    {
        $this->data = $data;
    }


    public function setResult(Collection|ServiceResult $result = null, int|null $statusCode = null, int|null $failedCode = null, null|array|string $message = null): void
    {

        if ($result->result) {
            $this->setMessage($message);
            $this->setStatus($statusCode ?? $result->statusCode ?? 200);
            $this->setStatusMessage($statusCode ?? $result->statusCode ?? 200);
            $this->setData($result->data ?? []);


        } else {
            $this->setMessage($message ?? 'failed');
            $this->setStatus($failedCode ?? $result->statusCode ?? 500);
            $this->setStatusMessage($failedCode ?? $result->statusCode ?? 500);
            $this->setData($result->data ?? []);

        }
    }

    public function build(): JsonResponse
    {

        return response()->json([
            'message' => $this->message,
            'status' => $this->statusCode,
            'result' => $this->statusMessage,
            'data' => $this->data['data'] ?? $this->data,
        ])->setStatusCode($this->statusCode);
    }
}
