<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = array('id');

    public static $rules = array(
        'name' => 'required',
    );

    public function musers()
    {
        return $this->hasMany(Muser::class);
    }
}
