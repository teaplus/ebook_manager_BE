<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable =['content', 'user_id', 'story_id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function story(){
        return $this->belongsTo(Story::class);
    }

    public function user(){
        return $this->belongsTo(user::class);
    }

    
}
