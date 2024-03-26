
<?php

namespace App\Enums;

enum STATUS: string
{
  case PENDING = 'pending';
  case IN_PROGRESS = 'in_progress';
  case BLOCKED = 'blocked';
  case DONE = 'done';
  case DELETED = 'deleted';
}
