<?php

namespace Modules\Main\Action;

class ServiceResult
{
    public function __construct(public bool $result ,public int $statusCode = 200 ,public mixed $data =null )
    {

    }
}
