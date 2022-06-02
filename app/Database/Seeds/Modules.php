<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Modules extends Seeder
{
    public function run()
    {
        //
        $data = [
          [
            'id' => 1,
            'module_name' => 'Stammdaten',
            'module_path' => 'masterdata'
          ],
          [
            'id' => 2,
            'module_name' => 'Rechnungen',
            'module_path' => 'invoice'
          ]
        ];

        foreach ($data  as $row)
          $this->db->table('modules')->insert($row);


    }
}
