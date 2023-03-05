<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Requests extends Migration
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
          'description'  => [
            'type' => 'VARCHAR',
            'constraint' => 1000,
            'null' => false
          ],
          'startpoint DATETIME',
          'endpoint DATETIME',
          'created_at DATETIME',
          'requester' => [
            'type' => 'INT',
            'constraint' => 10,
            'null' => false
          ],
          'request_type' => [
            'type' => 'INT',
            'constraint' => 10,
            'null' => false
          ],
          'status' => [
            'type' => 'INT',
            'constraint' => 10,
            'null' => false
          ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('requests', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('requests');
    }
}
