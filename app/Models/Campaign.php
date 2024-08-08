<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'subject', 'previewText', 'htmlContent', 'status'
    ];

    protected $hidden = [
        'id'
    ];

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
