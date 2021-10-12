<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $param = [
      'name' => '管理者',
    ];
    $genre = new Role;
    $genre->fill($param)->save();
    $param = [
      'name' => '店長',
    ];
    $genre = new Role;
    $genre->fill($param)->save();
    $param = [
      'name' => '従業員',
    ];
    $genre = new Role;
    $genre->fill($param)->save();
  }
}
