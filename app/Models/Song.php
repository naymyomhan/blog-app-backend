<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['artist_id', 'title', 'composer', 'lyrics', 'lyrics_image', 'uploader', 'confirmed'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
