<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Evaluation;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'area_id' => 'required',
        'genre_id' => 'required',
        'detail' => 'required',
    );

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function reserves()
    {
        return $this->hasMany('App\Models\Reserve');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
