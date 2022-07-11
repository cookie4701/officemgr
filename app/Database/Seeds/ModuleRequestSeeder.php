<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModuleRequestSeeder extends Seeder
{
    public function run()
    {
        // insert model postregister
        $data = [
          [
            'id' => 4,
            'module_name' => 'Anfragen',
            'module_path' => 'requests'
          ]
        ];

        foreach ($data  as $row)
          $this->db->table('modules')->insert($row);

        $data = [
          'user' => 1,
          'module' => 4
        ];

        $this->db->table('module_user')->insert($data);

        // request types
        $data = [
          [
            'label' => 'Minibus Reservierung'
          ],
          [
            'label' => 'Urlaubsantrag'
          ],
          [
            'label' => 'Weiterbildung'
          ],
          [
            'label' => 'Homeoffice'
          ]
        ];

        foreach ($data  as $row)
          $this->db->table('request_types')->insert($row);

        $data = [
          [ 'label' => 'Übermittelt, Entscheidung offen' ],
          [ 'label' => 'Angenommen' ],
          [ 'label' => 'Abgelehnt' ],
          [ 'label' => 'Änderung erbeten' ]
        ];

        foreach ($data  as $row)
          $this->db->table('request_status')->insert($row);
    }
}
