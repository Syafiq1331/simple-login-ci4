<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'john_doe',
                'email'    => 'john@example.com',
                'password' => password_hash('secret', PASSWORD_DEFAULT)
            ],
            [
                'username' => 'jane_doe',
                'email'    => 'jane@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT)
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
