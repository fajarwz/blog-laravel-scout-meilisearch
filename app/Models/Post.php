<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'published',
        'category_id',
    ];

    // protected $with = [
    //     'category'
    // ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->title,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'published' => (bool) $this->published,
            'category_id' => (int) $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    
    // Conditionally Searchable Model Instances
    public function shouldBeSearchable(): bool
    {
        return $this->published;
    }
}
