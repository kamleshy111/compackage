<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipPlans extends Model
{
    use HasFactory;

    /**
     * Get all of the years for the MembershipPlans
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function years(): HasMany
    {
        return $this->hasMany(MembershipPlanYears::class, 'plan_id', 'id');
    }

    public function planWithYears()
    {
        $years = $this->with('years');
        dd($years);
    }
}
