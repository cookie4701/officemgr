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
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'friendly_name');
    }
}
