<?php

namespace Database\Seeders;

use App\AlterBase\Models\User\User;
use App\AlterBase\Models\User\UserSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        app(User::class)->truncate();
        app(UserSetting::class)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $data = [
            'name' => "Sudip Ranjeet",
            'email' => "lycansu@gmail.com",
            'password' => "123456",
            'verified' => 1,
            'active' => 1,
            'guard' => 'web',
            'user_type' => 'web',
        ];

        $user = User::create($data);

        $data = [
          'user_id' => $user->id,
          'dark_mode' => false
        ];

        UserSetting::create($data);
    }
}
