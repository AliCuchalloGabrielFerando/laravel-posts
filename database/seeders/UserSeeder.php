<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        $user = new User;
        $user->name = 'root';
        $user->email = 'root@root.com';
        $user->password = bcrypt('12345678');
        $user->save();

    }
}
