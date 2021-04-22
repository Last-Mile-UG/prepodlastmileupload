<?php

namespace App\Enum;

class OrderStatusEnum
{
    public const AWAITING_PAYMENT = 'awaiting_payment';
    public const PAID = 'paid';
    public const PAYMENT_FAILED = 'payment_failed';
}
