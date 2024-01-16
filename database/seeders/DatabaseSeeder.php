<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class
        ]);

        $revisor = Role::where('name', 'Revisor')->get();

        User::factory(5)
            ->hasAttached($revisor)
            ->create();

        $roles = Role::all();

        User::factory(2)
            ->hasAttached($roles)
            ->create();

        Product::factory(8)->create();
    }
}
