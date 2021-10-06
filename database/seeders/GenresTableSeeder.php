<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '寿司',
        ];
        $genre = new Genre;
        $genre->fill($param)->save();
        $param = [
            'name' => '焼肉',
        ];
        $genre = new Genre;
        $genre->fill($param)->save();
        $param = [
            'name' => '居酒屋',
        ];
        $genre = new Genre;
        $genre->fill($param)->save();
        $param = [
            'name' => 'イタリアン',
        ];
        $genre = new Genre;
        $genre->fill($param)->save();
        $param = [
            'name' => 'ラーメン',
        ];
        $genre = new Genre;
        $genre->fill($param)->save();
    }
}
