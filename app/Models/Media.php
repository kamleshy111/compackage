<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'filenname',
        'extension',
        'size',
        'path',
        'notes',
        'uploaded_by',
        'added_by',
        'modified_by',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'size' => 'array',
    ];

    /**
     * Relation to user table.
     */
    public function added_by_user(){
        return $this->belongsTo('App\Models\User','added_by','id');
    }
}
