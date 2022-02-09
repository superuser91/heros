<?php

namespace Vgplay\Heros\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vgplay\Heros\Database\Factories\ClanFactory;
use Vgplay\LaravelRedisModel\Contracts\Cacheable;
use Vgplay\LaravelRedisModel\HasCache;

class Clan extends Model implements Cacheable
{
    use HasFactory;
    use HasCache;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'icon',
        'video',
        'stats',
        'desc',
        'order'
    ];

    protected $casts = [
        'stats' => 'json'
    ];

    protected static function newFactory()
    {
        return ClanFactory::new();
    }

    public function heroes()
    {
        return $this->hasMany(Hero::class);
    }

    public function scopeCacheWithRelation($query)
    {
        return $query->with('heroes');
    }
}
