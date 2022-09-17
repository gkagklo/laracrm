<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => 1
        ]);

        $moderator = User::create([
            'name' => 'Moderator',
            'email' => 'moderator@moderator.com',
            'password' => bcrypt('moderator'),
            'role_id' => 2
        ]);

    }
}
