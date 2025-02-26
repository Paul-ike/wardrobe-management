<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Category;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
    }

    public function test_user_can_login()
    {
        // First, register a user
        $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Then, try to login
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token']);
    }

    public function test_authenticated_user_can_see_their_info()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/user');

        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'email']);
    }

    public function test_user_can_create_clothing_item()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(); // Create a category

        $response = $this->actingAs($user)->postJson('/api/clothing-items', [
            'name' => 'Test Item',
            'description' => 'This is a test item',
            'category_id' => $category->id, // Use the created category ID
        ]);

        $response->assertStatus(201);
    }

    public function test_user_can_see_all_clothing_items()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(); // Create a category

        // First, create an item
        $this->actingAs($user)->postJson('/api/clothing-items', [
            'name' => 'Test Item',
            'description' => 'This is a test item',
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($user)->getJson('/api/clothing-items');

        $response->assertStatus(200);
    }

    public function test_user_can_update_clothing_item()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(); // Create a category

        // First, create an item
        $item = $this->actingAs($user)->postJson('/api/clothing-items', [
            'name' => 'Test Item',
            'description' => 'This is a test item',
            'category_id' => $category->id,
        ]);

        // Then, update it
        $itemId = $item->json()['id'];

        $response = $this->actingAs($user)->putJson("/api/clothing-items/$itemId", [
            'name' => 'Updated Item',
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_delete_clothing_item()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(); // Create a category

        // First, create an item
        $item = $this->actingAs($user)->postJson('/api/clothing-items', [
            'name' => 'Test Item',
            'description' => 'This is a test item',
            'category_id' => $category->id,
        ]);

        // Then, delete it
        $itemId = $item->json()['id'];

        $response = $this->actingAs($user)->deleteJson("/api/clothing-items/$itemId");

        $response->assertStatus(200);
    }
}