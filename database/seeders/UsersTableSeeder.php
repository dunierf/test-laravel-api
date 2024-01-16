<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $root = new User([
            'id'	     => 1,
            'name'	     => 'Admin',
            'email'      => 'dunierf@gmail.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $root->save();
        $root->roles()->sync([1, 2]);
    }
}
