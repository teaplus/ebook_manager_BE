<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Story extends Model
{
    use HasFactory;

    // protected $table = "stories";
    protected $fillable = ['title', 'author_id', 'user_id', 'image_background', 'description', 'status'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'story_category');
    }


    // set default name to customize name author_id
    public function authors()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
