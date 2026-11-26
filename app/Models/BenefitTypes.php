<?php

namespace App\Models;

use App\Models\Benefit;
use Illuminate\Database\Eloquent\{Model, Factories\HasFactory};

class BenefitTypes extends Model
{
    use HasFactory;
    public $timestamps = true;

    /**
     * Get all of the benefits for the BenefitTypes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function benefits()
    {
        return $this->hasMany(Benefit::class, 'benefit_type_id', 'id');
    }
}
