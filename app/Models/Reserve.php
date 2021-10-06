<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Reserve extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $time = "H:i";

    public static $rules = array(
        'user_id' => 'required',
        'shop_id' => 'required',
        'date' => 'required',
        'time' => 'required',
        'number' => 'required',
    );
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
