<?php

namespace Modules\Shop\Enums;

enum OrderStatusEnum:string
{
    case none = 'none';
    case checking = 'checking';
    case confirmed = 'confirmed';
}
