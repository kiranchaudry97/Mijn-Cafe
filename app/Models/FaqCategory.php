<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;

    /**
     * De attributen die massaal ingevuld mogen worden.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    /**
     * Relatie: een categorie bevat meerdere FAQ-items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}