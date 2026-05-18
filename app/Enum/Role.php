<?php

namespace App\Enum;

enum Role : string
{
    case ADMIN = 'admin';
    case STAFF = 'staff';
    case EMPLOYEE = 'employee';
    case OPERATOR = 'operator';
}
