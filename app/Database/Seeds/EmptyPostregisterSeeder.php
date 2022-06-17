<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmptyPostregisterSeeder extends Seeder
{
    public function run()
    {
        //
        $this->db->table('postregister')->emptyTable();
    }
}
