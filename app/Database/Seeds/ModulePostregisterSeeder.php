<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModulePostregisterSeeder extends Seeder
{
    public function run()
    {
        // insert model postregister
        $data = [
          [
            'id' => 3,
            'module_name' => 'Dokumentverwaltung',
            'module_path' => 'postregister'
          ]
        ];

        foreach ($data  as $row)
          $this->db->table('modules')->insert($row);

        $data = [
          'user' => 1,
          'module' => 3
        ];

        $this->db->table('module_user')->insert($data);
    }
}
