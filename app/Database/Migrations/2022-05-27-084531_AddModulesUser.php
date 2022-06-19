<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddModulesUser extends Migration
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
          'user' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true
          ],
          'module' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true
          ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('module_user', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('module_user');
    }
}
