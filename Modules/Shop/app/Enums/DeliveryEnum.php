<?php

namespace Modules\Shop\Enums;

enum DeliveryEnum: string
{
    case none = 'none';
    case preparing = 'preparing';

    case sent = 'sent';
    case received = 'received';
}
