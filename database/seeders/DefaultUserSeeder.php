<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('email', 'project@admin.com')->count() == 0) {
            $user = User::create([
                'name' => 'John Doe',
                'email' => 'project@admin.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
            $user->creation_token = null;
            $user->save();
        }
    }
}
