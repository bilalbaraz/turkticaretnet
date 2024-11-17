<?php

namespace App\Enums;

enum OrderStatusEnums
{
    const CREATED = 'CREATED';
    const CANCELED = 'CANCELED';
    const SHIPPED = 'SHIPPED';
    const DELIVERED = 'DELIVERED';
}