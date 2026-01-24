<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Note extends Model
{
    protected $fillable = ['title', 'content', 'is_pinned', 'user_id', 'folder_id'];



    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
    
}