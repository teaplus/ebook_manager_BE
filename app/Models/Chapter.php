<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['story_id', 'chapter_number', 'title', 'content'];

    public function story(){
        return $this->belongsTo(Story::class);
    }

}
