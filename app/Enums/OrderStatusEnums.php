<?php

namespace App\Enums;

enum OrderStatusEnums
{
    const PENDING = 'PENDING';
    const ORDERED = 'ORDERED';
    const CANCELED = 'CANCELED';
    const SHIPPED = 'SHIPPED';
}