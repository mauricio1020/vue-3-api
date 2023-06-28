<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            "email" => "app@cursosdesarrolloweb.es",
            "name" => "Cursosdesarrolloweb"
        ]);
        User::factory(10)->create();
        Book::factory(52)->create();
    }
}
