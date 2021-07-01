<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'progress',
        'created_by',
        'updated_by',
        'deleted_by',
        'user_id',
        'deleted_at',
    ];
}
