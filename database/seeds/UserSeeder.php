<?php

use Illuminate\Database\Seeder;

use App\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $user->name = "Administrador";
        $user->email = "admin@admin.com";
        $user->email_verified_at = Carbon::now('America/Santiago');
        $user->password = Hash::make('12345678');
        $user->save();
    }
}
