<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
        'path', 
        'extension',
        'size',
        'description',
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sharedWith()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('permission')
                    ->withTimestamps();
    }

    public function sharedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
