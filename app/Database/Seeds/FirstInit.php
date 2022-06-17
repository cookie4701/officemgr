<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FirstInit extends Seeder
{
    public function run()
    {
        //
        $this->call('EmptyTablesSeeder');
        $this->call('Demouser');
        $this->call('Modules');
        $this->call('ModuleUser');
        $this->call('ModulePostregisterSeeder');
    }
}
