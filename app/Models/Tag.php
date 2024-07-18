<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function campaigns(): MorphToMany
    {
        return $this->morphedByMany(Campaign::class, 'taggable');
    }

    public function clients(): MorphToMany
    {
        return $this->morphedByMany(Client::class, 'taggable');
    }

    public function mails(): MorphToMany
    {
        return $this->morphedByMany(Mail::class, 'taggable');
    }
}
