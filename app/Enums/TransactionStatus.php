<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case OK ='Finalizada';

    case OFF ='Não Finalizada';
}
