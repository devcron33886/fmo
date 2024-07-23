<?php

namespace App\Enums\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ProjectStatus: string implements HasColor, HasIcon, HasLabel
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case ACTIVE = 'active';
    case CANCELLED = 'cancelled';

    public function getLabel(): string
    {
        return ucfirst(strtolower($this->value));
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::PENDING => 'heroicon-o-clock',
            self::IN_PROGRESS => 'heroicon-o-play-circle',
            self::ACTIVE => 'heroicon-o-check-badge',
            self::CANCELLED => 'heroicon-o-x-circle',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::IN_PROGRESS => 'info',
            self::ACTIVE => 'success',
            self::CANCELLED => 'primary',
        };
    }
}
