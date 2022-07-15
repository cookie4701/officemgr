<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModuleRequestSeeder extends Seeder
{
    public function run()
    {
      // request types
        $data = [
          [
            'id' => 1,
            'label' => 'Minibus Reservierung',
            'visibility' => 1
          ],
          [
            'id' => 2,
            'label' => 'Urlaubsantrag',
            'visibility' => 1
          ],
          [
            'id' => 3,
            'label' => 'Weiterbildung',
            'visibility' => 1
          ],
          [
            'id' => 4,
            'label' => 'Homeoffice',
            'visibility' => 1
          ]
        ];

        foreach ($data  as $row)
          $this->db->table('request_types')->insert($row);

        $data = [
          [ 'id' => 1, 'label' => 'Übermittelt, Entscheidung offen' ],
          [ 'id' => 2, 'label' => 'Angenommen' ],
          [ 'id' => 3, 'label' => 'Abgelehnt' ],
          [ 'id' => 4, 'label' => 'Änderung erbeten' ]
        ];

        foreach ($data  as $row)
          $this->db->table('request_status')->insert($row);
    }
}
