<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;
    
    // relazione con i project
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
 
}
