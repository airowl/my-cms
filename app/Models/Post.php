<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parentId',
        'title',
        'metaTitle',
        'slug',
        'summury',
        'published',
        'publishedAt',
        'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getSummury()
    {
        return (object)[
            'id' => $this->id,
            'parentId' => $this->parentId,
            'title' => $this->title,
            'metaTitle' => $this->metaTitle,
            'slug' => $this->slug,
            'summury' => $this->summury,
            'published' => $this->published,
            'publishedAt' => $this->publishedAt,
            'content' => $this->content,
            'author' => $this->user->getSummery()
        ];
    }
}
