<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory;
    // use Searchable;

    protected $casts = [
        'upload_at' => 'datetime',
    ];

    // public function toSearchableArray()
    // {
    //     return [
    //         'name' => $this->name,
    //         'description' => $this->description,
    //     ];
    // }

    protected $fillable = [
        'name',
        'description',
        'image',
        'file',
        'previous_id',
        'next_id',
        'uploader',
        'read_count',
        'upload_at',
    ];
}
