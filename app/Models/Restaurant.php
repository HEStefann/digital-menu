<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'instagram',
        'facebook',
        'twitter',
        'linkedin',
        'website',
        'user_id',
        'logo',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function Menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
