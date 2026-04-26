<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMsgContenuToMessageTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('t_message_msg', [
            'msg_contenu' => [
                'type'       => 'TEXT',
                'constraint' => 500,
                'null'       => false,
                'after'      => 'msg_objet'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('t_message_msg', 'msg_contenu');
    }
}
