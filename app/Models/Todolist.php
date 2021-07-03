<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todolist extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'progress',
        'comment',
        'created_by',
        'updated_by',
        'deleted_by',
        'user_id',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
