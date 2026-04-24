<?php
namespace App\Controllers;

class TestDB extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        $tables = [
            'comptes'  => $db->query("SELECT * FROM t_compte_cpt")->getResultArray(),
            'profils'  => $db->query("SELECT * FROM t_profil_pfl")->getResultArray(),
            'devis'    => $db->query("SELECT * FROM t_devis_dev")->getResultArray(),
            'details'  => $db->query("SELECT * FROM t_detail_det")->getResultArray(),
            'messages' => $db->query("SELECT * FROM t_message_msg")->getResultArray(),
        ];

        return view('test_db', $tables);
    }
}