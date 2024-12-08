<?php

namespace Modules\Shop\Enums;

enum PaymentEnum:string
{
    case prepay = 'prepay';
    case paid = 'paid';
    case offlinePaid = 'offline paid';
    case returned = 'returned';
    case failed = 'failed';
}
