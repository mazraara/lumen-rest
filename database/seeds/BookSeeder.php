<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->delete();
        DB::table('books')->insert([
            'title' => 'Lumen',
            'description' => 'Lumen best practices.',
            'picture' => 'https://via.placeholder.com/150x150',
            'category_id' => 1,
            'user_id' => 1,
            'published' => true,
        ]);
    }
}
