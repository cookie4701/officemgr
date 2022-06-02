<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInvoiceItem extends Migration
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
          'invoice' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true,
          ],
          'position' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true
          ],
          'label' => [
            'type' => 'VARCHAR',
            'constraint' => 200
          ],
          'vat' => [
            'type' => 'DOUBLE',
            'null' => true
          ],
          'amount' => [
            'type' => 'DOUBLE',
            'null' => false
          ],
          'unit_price' => [
            'type' => 'DOUBLE',
            'null' => false
          ]

        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('invoice_item');
    }

    public function down()
    {
        //
        $this->forge->dropTable('invoice_item');
    }
}
