<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Nguyễn Thị Xuân Khánh',
            'email' => 'Khánh@example.com',
            'password' => Hash::make('12345678'),
        ]);

        Profile::create([
            'uid' => $user->id,
            'username' => 'Khanhs3043',
            'avatar' => 'path/to/avatar.jpg',
            'dob' => '2003-01-01',
            'bio' => 'This is a bio',
            'gender' => 'Male',
        ]);

        $user1 = User::create([
            'name' => 'Nguyễn Thị Quỳnh Trang',
            'email' => 'Trang@example.com',
            'password' => Hash::make('12345678'),
        ]);

        Profile::create([
            'uid' => $user1->id,
            'username' => 'Trangggg',
            'avatar' => 'path/to/avatar.jpg',
            'dob' => '2003-04-24',
            'bio' => 'This is a bio',
            'gender' => 'Male',
        ]);

        $user2 = User::create([
            'name' => 'Nguyễn Diệu Linh',
            'email' => 'Linh@example.com',
            'password' => Hash::make('12345678'),
        ]);

        Profile::create([
            'uid' => $user1->id,
            'username' => 'LinLin',
            'avatar' => 'path/to/avatar.jpg',
            'dob' => '2003-01-31',
            'bio' => 'This is a bio',
            'gender' => 'Female',
        ]);

    }
}
