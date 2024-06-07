<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            'uid' => 1,
            'name' => 'Nguyễn Thị Xuân Khánh',
            'avatar' => 'path/to/avatar.jpg',
            'dob' => '1990-01-01',
            'bio' => 'This is a bio',
            'gender' => 'Male',
        ]);

        Profile::create([
            'uid' => 2,
            'name' => 'Nguyễn Thị Quỳnh Trang',
            'dob' => '1985-05-05',
            'bio' => 'This is another bio',
            'gender' => 'Male',
        ]);
        Profile::create([
            'uid' => 3,
            'name' => 'Nguyễn Diệu Linh',
            'dob' => '1985-24-08',
            'bio' => 'This is another bio',
            'gender' => 'Male',
        ]);
    }
}
