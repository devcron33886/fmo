<?php

namespace App\Enums\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum GenderEnum: string implements HasColor, HasIcon, HasLabel
{
    case MALE = 'male';
    case FEMALE = 'female';

    public function getLabel(): string
    {
        return ucfirst($this->value);
    }

    public function getIcon(): string
    {
        return 'heroicon-o-user-circle';
    }

    public function getColor(): string
    {
        return match ($this) {
            self::MALE => 'sky',
            self::FEMALE => 'green',
        };
    }
}
