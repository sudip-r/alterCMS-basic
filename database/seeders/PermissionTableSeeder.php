<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
  /**
     * @var array
     */
    protected $modules = [
      \App\AlterBase\Permissions\UserPermission::class,
      \App\AlterBase\Permissions\SettingPermission::class,
      // \App\AlterBase\Permissions\MessagePermission::class,
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      DB::table('permissions')->truncate();
      DB::table('modules')->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1');       

      foreach($this->modules as $module){
          app($module)->store();
      }
    }
}
