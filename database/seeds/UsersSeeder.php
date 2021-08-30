<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = config('users');

        foreach ($users as $user) {
            $newUser = new User();

            $newUser->email = $user['email'];
            $newUser->password = Hash::make($user['password']);
            $newUser->first_name = $user['first_name'];
            $newUser->last_name = $user['last_name'];
            $newUser->about = $user['about'];
            $newUser->phone = $user['phone'];
            $newUser->profile_pic = $user['profile_pic'];

            $newUser->save();
        }
    }
}
