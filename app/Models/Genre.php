<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;


class Genre extends Model
{
    use HasFactory;

    protected $fillable = array('id');

    public static $rules = array(
        'name' => 'required',
    );

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
