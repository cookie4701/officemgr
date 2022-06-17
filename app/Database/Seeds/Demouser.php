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
          'friendly_name' => 'Pascal',
          'password' => '$2y$10$6U/LUDIe24b4T93T7g7Gg.N9rYxLulTi2Bw3UJEp6mBt1p.g9oCNu'
        ];

        $this->db->table('users')->insert($data);

        $data = [
          'id' => 2,
          'email' => 'jacques@pkit.eu',
          'friendly_name' => 'Jacques',
          'password' => '$2y$10$6U/LUDIe24b4T93T7g7Gg.N9rYxLulTi2Bw3UJEp6mBt1p.g9oCNu'
        ];

        $this->db->table('users')->insert($data);

        $data = [
          [
            'id' => 1,
            'user' => 1
          ],
          [
            'id' => 2,
            'user' => 2
          ]
        ];
        foreach($data as $itm) $this->db->table('postregister_responsibles')->insert($itm);
    }
}
