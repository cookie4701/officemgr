<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RequestResponsible extends Migration
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
          'request_type'  => [
            'type' => 'VARCHAR',
            'constraint' => 1000,
            'null' => false
          ],
          'responsible_user'  => [
            'type' => 'VARCHAR',
            'constraint' => 1000,
            'null' => false
          ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('request_responsible', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('request_responsible');
    }
}
