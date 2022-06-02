<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPostregister extends Migration
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
          'document_type' => [
            'type' => 'VARCHAR',
            'constraint' => 20
          ],
          'document_number' => [
            'type' => 'INT',
            'constraint' => 5
          ],
          'post_date' => [
            'type' => 'DATE',
            'default' => 'NOW()'
          ],
          'area' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
          ],
          'description' => [
            'type' => 'TEXT'
          ],
          'assignee' => [
            'type' => 'VARCHAR',
            'constraint' => 50
          ]

        });

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('postregister');
    }

    public function down()
    {
        //
        $this->forge->dropTable('postregister');
    }
}
