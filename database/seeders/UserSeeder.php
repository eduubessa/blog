<?php

namespace Database\Seeders;

use App\Models\User;
use App\Notifications\ActivationAccount as ActivationAccountNotification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = new User();
        $user->avatar_id = 1;
        $user->firstname = encrypt_data("Webmaster");
        $user->lastname = encrypt_data("master");
        $user->username = "webmaster";
        $user->email = "webmaster@localhost";
        $user->mobile_phone = "9191919192";
        $user->password = bcrypt("password");
        $user->save();

        // Create activation account token
        $user->activationAccount()->create([
            'token' => Crypt::encrypt(uniqid())
        ]);

        //Send email to webmaster@localhost
        $user->notify(new ActivationAccountNotification);
        $user = new User();
        $user->avatar_id = 1;
        $user->firstname = encrypt_data("Administrador");
        $user->lastname = encrypt_data("admin");
        $user->username = "administrador";
        $user->email = "admin@localhost";
        $user->mobile_phone = "9191919191";
        $user->password = bcrypt("password");
        $user->save();

        // Create activation account token
        $user->activationAccount()->create([
            'token' => Crypt::encrypt(uniqid())
        ]);

        $user->notify(new ActivationAccountNotification);

        //
        if(env('APP_DEBUG')) {
            $user = new User();
            $user->avatar_id = 1;
            $user->firstname = encrypt_data("Eduardo");
            $user->lastname = encrypt_data("Bessa");
            $user->username = "eduardo.bessa";
            $user->email = "eduardo.bessa@localhost";
            $user->mobile_phone = "913946525";
            $user->password = bcrypt("password");
            $user->save();

            // Create activation account token
            $user->activationAccount()->create([
                'token' => Crypt::encrypt(uniqid())
            ]);

            $user->notify(new ActivationAccountNotification);
        }
    }
}
