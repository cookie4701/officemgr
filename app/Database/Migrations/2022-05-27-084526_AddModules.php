<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddModules extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
          'id' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true,
            'auto_increment' => true
          ],
          'module_name' => [
            'type' => 'VARCHAR',
            'constraint' => 20
          ],
          'module_path' => [
            'type' => 'VARCHAR',
            'constraint' => 1000
          ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('modules', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('modules');
    }
}
