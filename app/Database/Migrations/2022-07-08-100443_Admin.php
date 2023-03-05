<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        //
        $this->forge->addField ([
          'id' => [
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
          ],
          'user'  => [
            'type' => 'INT',
            'constraint' => 10,
            'null' => false
          ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('administrators', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('administrators');
    }
}
