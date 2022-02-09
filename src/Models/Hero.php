<?php

namespace Vgplay\Heros\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vgplay\Heros\Database\Factories\HeroFactory;
use Vgplay\LaravelRedisModel\Contracts\Cacheable;
use Vgplay\LaravelRedisModel\HasCache;

class Hero extends Model implements Cacheable
{
    use HasFactory;
    use HasCache;

    protected $table = 'heroes';

    protected $fillable = [
        'name',
        'clan_id',
        'slug',
        'image',
        'icon',
        'video',
        'stats',
        'skills',
        'desc',
        'order'
    ];

    protected $touches = ['clan'];

    protected $casts = [
        'stats' => 'json',
        'skills' => 'json',
    ];

    protected static function newFactory()
    {
        return HeroFactory::new();
    }

    public function clan()
    {
        return $this->belongsTo(Clan::class);
    }
}
