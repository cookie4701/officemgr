<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use CodeIgniter\Database\RawSql;

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
            'type' => 'DATETIME',
            'default' => new RawSql('CURRENT_TIMESTAMP')
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

        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('postregister', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('postregister');
    }
}
