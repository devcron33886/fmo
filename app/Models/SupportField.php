<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportField extends Model
{
    use HasFactory;

    protected $fillable = ['support_id', 'field_id', 'value'];
}
