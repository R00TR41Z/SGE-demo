<?php

namespace App\Enums;

enum MonthfeeStatus: string
{
    case UNPAID = 'Pendente';
    case PAID = 'Paga';
}
