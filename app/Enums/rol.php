<?php

namespace App\Enums;

enum ROL: string
{
  case SUPERADMIN = 'superadmin';
  case EMPLOYEE = 'employee';
  case NOACCESS = 'noaccess';
}
