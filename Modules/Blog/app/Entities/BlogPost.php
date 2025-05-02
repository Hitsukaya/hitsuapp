<?php

namespace Modules\Blog\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Modules\Blog\Enums\BlogStatus;
use Modules\Blog\Events\NewBlogPostPublished;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'sub_title',
        'cover_image',
        'body_small',
        'body_full',
        'button_text',
        'meta_title',
        'meta_description',
        'status',
        'published_at',
        'scheduled_for',
        'user_id',
    ];

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag')->withTimestamps();
    }


    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }

    public function isNotPublished()
    {
        return $this->status !== BlogStatus::PUBLISHED->value;
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', BlogStatus::PUBLISHED->value)->latest('published_at');
    }

    public function scopeScheduled(Builder $query)
    {
        return $query->where('status', BlogStatus::SCHEDULED->value)->latest('scheduled_for');
    }

    public function scopePending(Builder $query)
    {
        return $query->where('status', BlogStatus::PENDING->value)->latest('created_at');
    }

    public function formattedPublishedDate()
    {
        return $this->published_at?->format('d M Y');
    }

    public function isScheduled()
    {
        return $this->status === BlogStatus::SCHEDULED->value;
    }

    public function isStatusPublished()
    {
        return $this->status === BlogStatus::PUBLISHED->value;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updated(function ($post) {
            if (
                $post->wasChanged('status') &&
                $post->status === BlogStatus::PUBLISHED->value
            ) {
                event(new NewBlogPostPublished($post));
            }
        });
    }

    protected $dates = [
        'scheduled_for',
    ];

    protected $casts = [
        'id' => 'integer',
        'published_at' => 'datetime',
        'scheduled_for' => 'datetime',
        'status' => BlogStatus::class,
        'user_id' => 'integer',
    ];
}
