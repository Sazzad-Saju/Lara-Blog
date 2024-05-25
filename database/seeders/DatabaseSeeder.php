<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // $user = User::factory()->create([
        //     'name' => 'Sazzad Saju'
        // ]);
        
        // Post::factory(30)->create([
        //     'user_id' => $user->id,
        // ]);
        
        //Seed Primary User
        User::create([
            'name' => 'Admin',
            'user_name' => 'SuperAdmin',
            'email' => 'admin@larablog.com',
            'is_admin' => 1,
            'password' => '123456',
        ]);
    }
}
