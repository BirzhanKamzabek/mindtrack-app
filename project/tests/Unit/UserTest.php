<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation()
{
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com'
    ]);
}
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
