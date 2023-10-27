<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'previous_id',
        'next_id',
        'uploader',
        'read_count',
        'upload_at',
    ];

    public function bookFile()
    {
        return $this->hasOne(BookFile::class);
    }
}
