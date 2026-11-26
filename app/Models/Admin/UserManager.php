<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserManager extends Model
{
    use HasFactory;

    public function industires()
    {
        return DB::table('industries')->get()->toArray();
    }
}
