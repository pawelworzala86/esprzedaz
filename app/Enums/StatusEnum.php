<?php

namespace App\Enums;

enum StatusEnum: string
{
    case Available = 'available';
    case Pending = 'pending';
    case Sold = 'sold';
}
