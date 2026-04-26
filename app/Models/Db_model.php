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

    public function get_code($code)
    {
        $requete4 = "SELECT * FROM t_message_msg JOIN t_compte_cpt USING(cpt_pseudo) WHERE msg_code='" . $code . "';";
        $resultat4 = $this->db->query($requete4);
        return $resultat4->getRow();
    }

    public function set_message($saisie)
    {      
        $email   = htmlspecialchars(addslashes($saisie['email']));
        $objet   = htmlspecialchars(addslashes($saisie['objet']));
        $contenu = htmlspecialchars(addslashes($saisie['contenu']));
        $code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 20);
        $sql = "INSERT INTO t_message_msg (msg_email, msg_objet, msg_contenu, msg_date, msg_code, msg_response, cpt_pseudo) 
                VALUES ('$email', '$objet', '$contenu', CURDATE(), '$code', 'Demande en cours de traitement', NULL)";
        $this->db->query($sql);
        return $code;
    }

}
