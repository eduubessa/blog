<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
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
        $user->gender = 'male';
        $user->birth_date = now()->format('Y-m-d');
        $user->password = bcrypt('12345678');
        $user->save();

        $user = new User();
        $user->avatar = "default.png";
        $user->firstname = "Nuno";
        $user->lastname = "Santos";
        $user->username = "nuno.santos";
        $user->email = "nuno.santos@gmail.com";
        $user->mobile_phone = "3519139446225";
        $user->gender = 'male';
        $user->birth_date = now()->format('Y-m-d');
        $user->password = bcrypt('12345678');
        $user->save();
    }
}
