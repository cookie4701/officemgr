<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmptyTablesSeeder extends Seeder
{
    public function run()
    {
        //
        $this->db->table('invoice_item')->emptyTable();
        $this->db->table('invoices')->emptyTable();
        $this->db->table('masterdata_partners')->emptyTable();
        $this->db->table('migrations')->emptyTable();
        $this->db->table('module_user')->emptyTable();
        $this->db->table('modules')->emptyTable();
        $this->db->table('postregister')->emptyTable();
        $this->db->table('users')->emptyTable();
        $this->db->table('postregister_responsibles')->emptyTable();
        $this->db->table('request_types')->emptyTable();
        $this->db->table('request_status')->emptyTable();
        $this->db->table('requests')->emptyTable();
        $this->db->table('requests_responsibles')->emptyTable();
    }
}
