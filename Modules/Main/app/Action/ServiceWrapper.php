<?php

namespace Modules\Main\Action;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ServiceWrapper
{

    public function __invoke(\Closure $action, \Closure $reject = null, $hasTransaction = true, $handler = false): ServiceResult
    {
        if ($handler) {
            if ($hasTransaction) return $this->implementTransaction($action, $reject);
            else return $this->implementWithoutTransaction($action, $reject);
        } else {
            return $this->withoutExceptionHandler($action);
        }
    }

    private function implementTransaction(\Closure $action, \Closure $reject = null): ServiceResult
    {
        DB::beginTransaction();
        try {
            $actionResult = new ServiceResult(true, 200, $action());
            DB::commit();
            return $actionResult;
        } catch (\Exception $exception) {
            !is_null($reject) && $reject();
            Log::error($exception);
            DB::rollBack();
            $this->sendErrorEmail($exception);

            return new ServiceResult(false, 500);
        }
    }

    private function implementWithoutTransaction(\Closure $action, \Closure $reject = null): ServiceResult
    {
        try {
            return new ServiceResult(true, 200, $action());
        } catch (\Exception $exception) {
            !is_null($reject) && $reject();
            Log::error($exception);
            $this->sendErrorEmail($exception);

            return new ServiceResult(false, 500);
        }
    }

    private function withoutExceptionHandler(\Closure $action): ServiceResult
    {
        return new ServiceResult(true, 200, $action());
    }

    private function sendErrorEmail($exception)
    {
//        $email = 'sina.zangiband@gmail.com';
//        $titleError = 'ERROR on BARSASOFT[dot]COM';
//        Notification::route('mail', $email)->notify(new EmailNotification($titleError, $exception->getMessage()));
    }
}
