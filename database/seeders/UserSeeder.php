<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = new User();
        $user->avatar = "default.png";
        $user->firstname = "Eduardo";
        $user->lastname = "Bessa";
        $user->username = "eduardo.bessa";
        $user->email = "KuUeh@example.com";
        $user->mobile_phone = "3519139446525";
        $user->password = bcrypt('12345678');
        $user->save();
    }
}
