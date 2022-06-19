<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPostregisterWorkareas extends Migration
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
          'workarea'  => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => false
          ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('postregister_workareas', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('postregister_workareas');
    }
}
