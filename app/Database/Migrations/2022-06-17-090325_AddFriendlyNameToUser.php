<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFriendlyNameToUser extends Migration
{
    public function up()
    {
        $fields = [
          'friendly_name' => [
            'constraint' => 50,
            'type' => 'VARCHAR'
          ]
        ];
        if (! $this->db->fieldExists('friendly_name', 'users') )
          $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'friendly_name');
    }
}
