<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class File extends Model
{
    use HasUuids;

    public $timestamps = true;

    public $fillable = [
        'filename',
        'path',
        'size'
    ];
}
