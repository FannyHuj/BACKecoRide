<?php

namespace App\Entity;

enum EnergyEnum: string {
    case GASOLINE = 'essence';
    case DIESEL = 'diesel';
    case HYBRID = 'hybrid';
    case ELECTRIC = 'electric';
}