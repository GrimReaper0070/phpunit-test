<?php

namespace Ashraful\TestProject\Tests;

use Ashraful\TestProject\UserManager;
use InvalidArgumentException;
use PDO;
use PHPUnit\Framework\TestCase;

class UserManagerTest extends TestCase
{
    private $pdo;
    private $userManager;

    protected function setUp(): void
    {
        // Set up a PDO instance and pass it to the UserManager constructor
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT)');
        $this->userManager = new UserManager($this->pdo);
    }

    public function testCreateUser()
    {
        $userId = $this->userManager->createUser('John Doe');

        $this->assertGreaterThan(0, $userId);
    }

    public function testGetUser()
    {
        $userId = $this->userManager->createUser('Jane Smith');
        $user = $this->userManager->getUser($userId);

        $this->assertEquals('Jane Smith', $user['name']);
    }

    public function testUpdateUser()
    {
        $userId = $this->userManager->createUser('Alice');
        $this->userManager->updateUser($userId, 'Alice Johnson');
        $user = $this->userManager->getUser($userId);

        $this->assertEquals('Alice Johnson', $user['name']);
    }

    public function testDeleteUser()
    {
        $userId = $this->userManager->createUser('Bob');
        $this->userManager->deleteUser($userId);
        $user = $this->userManager->getUser($userId);

        $this->assertEmpty($user);
    }

    // Test invalid argument exception for createUser method
    public function testCreateUserWithEmptyName()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->userManager->createUser('');
    }

    // Test invalid argument exception for updateUser method
    public function testUpdateUserWithEmptyName()
    {
        $this->expectException(InvalidArgumentException::class);
        $userId = $this->userManager->createUser('John Doe');
        $this->userManager->updateUser($userId, '');
    }

    public function testDeleteNonExistingUser()
    {
        // No exception is expected here
        try {
            $this->userManager->deleteUser(999);
        } catch (\Exception $e) {
            // If an exception is caught, fail the test
            $this->fail("Unexpected exception: " . $e->getMessage());
        }
    
        // After attempting to delete a non-existing user, getUser should return an empty array or null
        $user = $this->userManager->getUser(999);
        $this->assertEmpty($user);
    }
}
