<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Evaluation extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    public static $rules = array(
        'comment' => 'required',
        'rate' => 'required',
        'shop_id' => 'required',
        'name' => 'required',
    );

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
