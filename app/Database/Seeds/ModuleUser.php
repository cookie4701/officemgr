<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModuleUser extends Seeder
{
    public function run()
    {
        //
        $data = [
          [
            'module' => 1,
            'user'  => 1
          ],
          [
            'module' => 2,
            'user'  => 1
          ]

        ];

        foreach($data as $row)
          $this->db->table('module_user')->insert($row);
    }
}
