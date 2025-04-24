<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Services\Entities\ServiceCategory;
use Modules\Services\Enums\ServiceStatus;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_image',
        'title',
        'slug',
        'body_small',
        'body_full',
        'button_text',
        'category_id',
        'status',
        'published_at',
        'scheduled_for',
    ];

    public function isNotPublished()
    {
        return $this->status !== ServiceStatus::PUBLISHED->value;
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', ServiceStatus::PUBLISHED->value)->latest('published_at');
    }

    public function scopeScheduled(Builder $query)
    {
        return $query->where('status', ServiceStatus::SCHEDULED->value)->latest('scheduled_for');
    }

    public function scopePending(Builder $query)
    {
        return $query->where('status', ServiceStatus::PENDING->value)->latest('created_at');
    }

    public function formattedPublishedDate()
    {
        return $this->published_at?->format('d M Y');
    }

    public function isScheduled()
    {
        return $this->status === ServiceStatus::SCHEDULED->value;
    }

    public function isStatusPublished()
    {
        return $this->status === ServiceStatus::PUBLISHED->value;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('title') && empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function categories()
    {
        return $this->belongsToMany(ServiceCategory::class, 'category_service', 'service_id', 'category_id');
    }

    protected $dates = [
        'scheduled_for',
    ];

    protected $casts = [
        'id' => 'integer',
        'published_at' => 'datetime',
        'scheduled_for' => 'datetime',
        'status' => ServiceStatus::class,
        'user_id' => 'integer',
    ];



}
