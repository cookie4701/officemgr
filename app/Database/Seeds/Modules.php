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
          ],
          [
            'id' => 3,
            'module_name' => 'Dokumentverwaltung',
            'module_path' => 'postregister'
          ],
          [
            'id' => 4,
            'module_name' => 'Anfragen',
            'module_path' => 'requests'
          ],
          [
            'id' => 5,
            'module_name' => 'Administration',
            'module_path' => 'admin'
          ],
          [
            'id' => 6,
            'module_name' => 'Verantwortl. Anfragen',
            'module_path' => 'requestsconfig'
          ],
          [
            'id' => 7,
            'module_name' => 'Anfragen bearbeiten',
            'module_path' => 'requests/process'
          ]
        ];

        foreach ($data  as $row)
          $this->db->table('modules')->insert($row);


    }
}
