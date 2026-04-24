<?php

namespace App\Models;
use CodeIgniter\Model;
class Db_model extends Model
{
    protected $db;
    public function __construct()
    {
    $this->db = db_connect(); //charger la base de données
    // ou
    // $this->db = \Config\Database::connect();
    }

    public function get_all_compte()
    {
    $resultat = $this->db->query("SELECT * FROM t_compte_cpt;");
    return $resultat->getResultArray();
    }
     public function lister()
    {
    $model = model(Db_model::class);
    $data['titre']="Liste de tous les comptes";
    $data['logins'] = $model->get_all_compte();
    return view('templates/haut', $data)
    . view('affichage_comptes')
    . view('templates/bas');
    }

}
