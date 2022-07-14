<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VisibilityRequests extends Migration
{
    public function up()
    {
        //
        $fields = [
          'visibility' => [
            'type' => 'INT',
            'constraint' => 10,
            'null' => true
          ]
        ];

        $this->forge->addColumn('request_types', $fields);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('request_types', 'visibility');
    }
}
