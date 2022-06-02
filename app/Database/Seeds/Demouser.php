<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Demouser extends Seeder
{
    public function run()
    {
        //
        $data = [
          'id' => 1,
          'email' => 'pascal@pkit.eu',
          'password' => '$2y$10$6U/LUDIe24b4T93T7g7Gg.N9rYxLulTi2Bw3UJEp6mBt1p.g9oCNu'
        ];

        $this->db->table('users')->insert($data);
    }
}
