<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    /**
     * De attributen die massaal ingevuld mogen worden.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'faq_category_id',
        'question',
        'answer',
    ];

    /**
     * Relatie: deze FAQ behoort tot één categorie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }
}