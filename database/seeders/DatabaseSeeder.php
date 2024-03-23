<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Post::factory()->create();
        
        $user = User::factory()->create([
            'name' => 'Sazzad Saju'
        ]);
        
        Post::factory(30)->create([
            'user_id' => $user->id,
        ]);
        
        // User::truncate();
        // Category::truncate();
        
        // $user = User::factory()->create();
        
        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);
        
        // $family = Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family'
        // ]);
        
        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work'
        // ]);

        // Post::create([
        //     'title' => 'My Family Post',
        //     'slug' => 'my-family-post',
        //     'excerpt' => 'Lorem ipsum dolor sit amet.',
        //     'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam cupiditate voluptas sapiente vero, repellat recusandae assumenda velit, repellendus dolor officiis ipsa vel natus molestias sed nobis esse! Quaerat cumque iure est enim nobis corrupti recusandae id repellendus dolorum sequi architecto voluptatum magni quod officia consectetur porro iste, ut aperiam, odit consequuntur repellat labore nesciunt reiciendis. Molestias quibusdam ad magni quia unde obcaecati quod recusandae totam!</p>',
        //     'category_id' => $family->id,
        //     'user_id' => $user->id
        // ]);
        
        // Post::create([
        //     'title' => 'My Work Post',
        //     'slug' => 'my-work-post',
        //     'excerpt' => 'Lorem ipsum dolor sit amet.',
        //     'body' => '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod aliquid iure nulla. Veritatis quod itaque sed illum repellat enim reiciendis maxime, ex officia magnam nemo illo asperiores laudantium non ipsam excepturi perferendis quisquam architecto impedit necessitatibus ad repellendus, laborum quam pariatur! Vel aliquam, molestiae cumque quos suscipit fuga maiores magnam.</p>',
        //     'category_id' => $work->id,
        //     'user_id' => $user->id
        // ]);
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
