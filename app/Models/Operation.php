<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'type_id',
        'file_name',
        'file_size',
        'created_at',
        'updated_at',
    ];
}
