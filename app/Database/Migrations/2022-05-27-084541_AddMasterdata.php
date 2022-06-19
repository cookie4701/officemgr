<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMasterdata extends Migration
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
          'orga_name' => [
            'type' => 'VARCHAR',
            'constraint' => 200
          ],
          'address1' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => true
          ],
          'address2' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => true
          ],
          'zip' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
            'null' => true
          ],
          'city' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => true
          ],
          'country' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
            'null' => true
          ],
          'vat' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => true
          ],
          'phone' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
            'null' => true
          ],
          'contact_name' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => true
          ],
          'contact_email' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => true
          ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('masterdata_partners', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('masterdata_partners');
    }
}
