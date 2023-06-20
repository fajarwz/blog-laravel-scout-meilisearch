<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use Searchable;
    use HasFactory;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
