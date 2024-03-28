<?php
// app/Models/GenreStory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryCategory extends Model
{
    protected $table = 'story_category'; // Tên của bảng liên kết

    protected $fillable = ['genre_id', 'story_id'];

    // Không cần quan hệ belongsTo hoặc bất kỳ phương thức nào khác, vì đây chỉ là một bảng liên kết
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
