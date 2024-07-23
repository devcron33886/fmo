<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasColor, HasIcon, HasLabel
{
    case OPEN = 'open';
    case CLOSED = 'closed';
    case ACTIVE = 'active';
    case ARCHIVED = 'inactive';

    public function getIcon(): string
    {
        return match ($this) {
            self::OPEN => 'heroicon-o-check-badge',
            self::CLOSED => 'heroicon-o-x-circle',
            self::ACTIVE => 'heroicon-o-check-badge',
            self::ARCHIVED => 'heroicon-o-x-circle',
        };
    }

    public function getLabel(): string
    {
        return ucfirst($this->value);
    }

    public function getColor(): string
    {
        return match ($this) {
            self::OPEN => 'success',
            self::CLOSED => 'primary',
            self::ACTIVE => 'success',
            self::ARCHIVED => 'primary',
        };
    }
}
