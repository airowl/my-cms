<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocalTranslation extends Model
{
    use HasFactory;

    protected $table = 'local_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'translation',
        'created_at',
        'updated_at'
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'local_language_id');
    }

    public function getSummery()
    {
        $summary = (object)[
            'id' => $this->id,
            'translation' => $this->translation,
            'languageCode' => $this->language->languageCode,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
        return $summary;
    }
}
