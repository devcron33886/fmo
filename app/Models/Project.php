<?php

namespace App\Models;

use App\Enums\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    protected $casts = ['created_at', 'updated_at', 'deleted_at', 'status' => ProjectStatus::class];
}
