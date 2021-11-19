<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;
    protected $table = 'plant';

    public function post(){
        return $this->hasMany(Post::class,'plant_id');
    }
    public function photos(){
        return $this->hasMany(Photo::class,'plant_id');
    }
}
