<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'languageCode',
        'translation',
    ];

    protected $attribues = [
        'languageCode',
        'translation',
    ];
}
