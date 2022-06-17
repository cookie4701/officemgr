<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPostResponsibles extends Migration
{
    public function up()
    {
        //
        $this->forge->addField ([
          'id' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true,
            'auto_increment' => true
          ],
          'user'  => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true
          ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('postregister_responsibles');
    }

    public function down()
    {
        //
    }
}
