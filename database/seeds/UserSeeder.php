<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hasher = app()->make('hash');
        $password = $hasher->make('user@123');
        $api_token = sha1(time());
        DB::table('users')->delete();
        DB::table('users')->insert([
            'username' => 'azraar',
            'email' => 'mazraara@gmail.com',
            'password' => $password,
            'api_token' => $api_token,
        ]);
    }
}
