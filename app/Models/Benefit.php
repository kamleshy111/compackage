<?php

namespace App\Models;

use App\Models\CustomCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Benefit extends Model
{
    use HasFactory;

    public $timestamps = true;

    /**
     * The companies that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies( $id = false )
    {
        if( ! empty( $id ) ) {
            return $this->belongsToMany(Company::class, 'company_benefit', 'benefit_id', 'company_id')->where('company_benefit.company_id', $id);
        } else {
            return $this->belongsToMany(Company::class, 'company_benefit', 'benefit_id', 'company_id');
        }
    }

    /**
     * The employee that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees( $id = false )
    {
        if( ! empty( $id ) ) {
            return $this->belongsToMany(Employee::class, 'benefit_employee', 'benefit_id', 'employee_id')->where('benefit_employee.employee_id', $id);
        } else {
            return $this->belongsToMany(Employee::class, 'benefit_employee', 'benefit_id', 'employee_id');
        }
    }

    /**
     * Get benefits by the category.
     */
    public function getBenifitsByCategory()
    {
        $company_id = auth()->user()->currentSessionCompany();

        dd(CustomCategory::get());
    }
}
