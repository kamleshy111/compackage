<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemoInquiry extends Model
{
    use HasFactory;

    public $timestamps = true;
    //public $fillable = [ 'id', 'firstname', 'lastname', 'email', 'phone', 'state', 'company', 'industry', 'num_employees', 'for_use_by', 'ip', 'subscribe', 'became_order', 'phoneext', 'count', 'deleted', 'add_id', 'edit_id', 'created_at', 'updated_at' ];

    public $fillable = [ 'id', 'firstname', 'lastname', 'email', 'phone', 'state', 'company', 'industry', 'num_employees', 'for_use_by', 'ip', 'subscribe', 'became_order', 'phoneext', 'signup_reference_from', 'OtherPleasedefine', 'UniversityWhichone', 'Organizationwhichone', 'WebSearchtermsearched', 'count', 'deleted', 'add_id', 'edit_id', 'created_at', 'updated_at' ];
    
    protected $casts = [
        'updated_at'  => 'date:m/d/Y g:i a',
    ];
    
    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->timezone('America/New_York')->format('m/d/Y g:i a');
    }

    protected $appends = ['fullName',];

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getFullNameAttribute()
    {
        return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }

    public function setAsOrder() {
        $this->became_order = 1;
        $this->save();
    }
}
