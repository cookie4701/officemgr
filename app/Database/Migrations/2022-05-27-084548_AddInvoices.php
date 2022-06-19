<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInvoices extends Migration
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
          'invoice_date' => [
            'type' => 'DATE',
            'null' => false
          ],
          'rcpt_orga' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => false
          ],
          'rcpt_contact' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => false
          ],
          'invoice_number' => [
            'type' => 'INT',
            'constraint' => 5,
            'null' => false
          ],
          'rcpt_address1' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => false
          ],
          'rcpt_address2' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => true
          ],
          'rcpt_zip' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => false
          ],
          'rcpt_city' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => false
          ],
          'rcpt_country' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => true
          ],
          'remark' => [
            'type' => 'TEXT',
            'null' => true
          ],
          'status' => [
            'type' => 'VARCHAR',
            'constraint' => 30,
            'null' => true
          ],
          'issuer_name' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => true
          ]

        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('invoices', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('invoices');
    }
}
