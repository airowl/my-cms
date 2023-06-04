<?php

namespace App\Models;

use App\Models\LocalTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;

    protected $table = 'local_languages';

    protected $fillable = [
        'languageCode',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(LocalTranslation::class);
    }
}
