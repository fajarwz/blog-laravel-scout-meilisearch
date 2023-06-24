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

    // Conditionally Searchable Model Instances
    public function shouldBeSearchable(): bool
    {
        return $this->published || $this->category->searchable;
    }

    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'category' => [
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
