<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RequestsResponsiblesMigration extends Migration
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
          ],
          'request_type' => [
            'type' => 'INT',
            'constraint' => 5,
            'null' => false
          ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('requests_responsibles', true);
    }

    public function down()
    {
        $this->forge->dropTable('requests_responsibles');
    }
}
