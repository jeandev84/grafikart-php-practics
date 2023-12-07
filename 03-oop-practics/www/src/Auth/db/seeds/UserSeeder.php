<?php

declare(strict_types=1);

use Framework\Security\Hash\PasswordHash;
use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $this->table('users')
             ->insert([
                 'username' => 'admin',
                 'email'    => 'admin@admin.fr',
                 'password' =>  PasswordHash::hash('admin')
             ]);
    }
}
