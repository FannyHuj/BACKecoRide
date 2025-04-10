<?php

namespace App\Entity;

enum TripsStatusEnum: string {
    case Coming = 'coming';
    case InProgress = 'inProgress';
    case Done = 'done';
    case Canceled = 'canceled';
}