<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // temporarily disable the mass assignment protection of the model
        Model::unguard();

        $this->call('UserSeeder');
        $this->call('BookSeeder');
        $this->call('CategorySeeder');

        Model::reguard();
    }
}
