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
        $requete4 = "SELECT * FROM t_message_msg LEFT JOIN t_compte_cpt USING(cpt_pseudo) WHERE msg_code='" . $code . "';";
        $resultat4 = $this->db->query($requete4);
        return $resultat4->getResultArray();
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

    public function get_membre()
    {
        $query = $this->db->query("SELECT COUNT(*) as total FROM t_compte_cpt;");
        return $query->getRow();
    }

    public function set_compte($saisie)
    {
        $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
        $data = [
            'cpt_pseudo' => $saisie['pseudo'],
            'cpt_mdp' => hash('sha256', $salt . $saisie['mdp']),
            'cpt_statut' => 'A'
        ];
        return $this->db->table('t_compte_cpt')->insert($data);
    }

    public function set_profil($saisie)
    {
        $data = [
            'pfl_nom' => $saisie['nom'],
            'pfl_prenom' => $saisie['prenom'],
            'pfl_adresse' => $saisie['adresse'],
            'pfl_telephone' => $saisie['telephone'],
            'pfl_entreprise' => $saisie['entreprise'] ?? null,
            'pfl_role' => 'M',
            'cpt_pseudo' => $saisie['pseudo']
        ];

        return $this->db->table('t_profil_pfl')->insert($data);
    }

    public function connect_compte($u, $p)
    {
        $u = addslashes($u);  
        $sql = "SELECT  cpt_pseudo, cpt_mdp
                FROM t_compte_cpt
                WHERE cpt_pseudo = '".$u."'";

        $query = $this->db->query($sql);

        if ($query->getNumRows() == 0) {
            return false;
        }

        $user = $query->getRow();
        $stored = $user->cpt_mdp;

        $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
        $sha256 = hash('sha256', $salt . $p);
        $md5 = md5($p);

        if ($stored === $sha256) {
            return $user;
        }
        if ($stored === $md5) {

            $new_hash = $sha256;

            $update_sql = "UPDATE t_compte_cpt
                        SET cpt_mdp = '".$new_hash."'
                        WHERE cpt_pseudo = '".$u."';";
            $this->db->query($update_sql);

            return $user;
        }
        return false;
    }



    public function get_profil($u)
    {
        $sql = "SELECT *
                FROM t_profil_pfl
                JOIN t_compte_cpt USING(cpt_pseudo)
                WHERE cpt_pseudo = '".$u."';";

        $query = $this->db->query($sql);

        if ($query->getNumRows() > 0) {
            return $query->getRowArray(); 
        }

        return false;
    }

    public function get_id_by_pseudo($pseudo)
    {
        $sql = "SELECT cpt_pseudo FROM t_compte_cpt WHERE cpt_pseudo = ?";
        $query = $this->db->query($sql, [$pseudo]);
        return $query->getRowArray();
    }
    
    public function get_role_by_pseudo($pseudo)
    {
        $sql = "SELECT *
                FROM t_profil_pfl 
                JOIN t_compte_cpt USING (cpt_pseudo)
                WHERE cpt_pseudo = '".$pseudo."'";
        $query = $this->db->query($sql);
        return $query->getRowArray();
    }
    public function get_profil_by_pseudo($pseudo)
    {
        $sql = "SELECT *
                FROM t_compte_cpt 
                LEFT JOIN t_profil_pfl USING (cpt_pseudo)
                WHERE cpt_pseudo = '".$pseudo."'";

        $query = $this->db->query($sql);
        return $query->getRowArray();
    }

    public function get_all_profil()
    {
        $resultat = $this->db->query("SELECT * FROM t_profil_pfl JOIN t_compte_cpt USING (cpt_pseudo);");
        return $resultat->getResultArray();
    }

        public function get_profils_num()
    {
            $requete2 = "SELECT COUNT(*) AS total_profil FROM t_profil_pfl;";
                        
            $resultat2 = $this->db->query($requete2);
            return $resultat2->getRow();
    }


    public function update_message($msg_id, $response, $cpt_pseudo)
    {
        $response = addslashes(htmlspecialchars($response));

        $sql = "UPDATE t_message_msg
                SET msg_response = '".$response."', 
                    cpt_pseudo = '".$cpt_pseudo."'
                WHERE msg_id = ".$msg_id;

        return $this->db->query($sql);
    }

    public function get_all_msg()
    {
        $resultat_message = $this->db->query("SELECT * FROM t_message_msg LEFT JOIN t_compte_cpt USING(cpt_pseudo) ORDER BY 
        CASE 
        WHEN msg_response = 'Demande en cours de traitement' THEN 0 
        ELSE 1 
    END,
    msg_date DESC;");
        return $resultat_message->getResultArray();
    }

    public function get_all_dev()
    {
        $sql = "SELECT * FROM t_devis_dev";
        return $this->db->query($sql)->getResultArray();
    }

    public function get_dev_by_user($pseudo)
    {
        $pseudo = addslashes($pseudo);

        $sql = "SELECT * 
                FROM t_devis_dev
                WHERE cpt_pseudo = '".$pseudo."'";

        return $this->db->query($sql)->getResultArray();
    }

    public function get_parametre($cle)
    {
        $cle = addslashes($cle);

        $sql = "SELECT * 
                FROM t_parametre_prm
                WHERE prm_cle = '".$cle."'";

        return $this->db->query($sql)->getRowArray();
    }

    public function get_user($pseudo)
    {
        $pseudo = addslashes($pseudo);

        $sql = "SELECT * 
                FROM t_compte_cpt
                WHERE cpt_pseudo = '".$pseudo."'";

        return $this->db->query($sql)->getRow();
    }

    public function update_statut($pseudo, $statut)
    {
        $pseudo = addslashes($pseudo);
        $statut = addslashes($statut);

        $sql = "UPDATE t_compte_cpt
                SET cpt_statut = '".$statut."'
                WHERE cpt_pseudo = '".$pseudo."'";

        return $this->db->query($sql);
    }

    public function delete_profil($pseudo)
    {
        $pseudo = addslashes($pseudo);

        $sql = "DELETE FROM t_profil_pfl
                WHERE cpt_pseudo = '".$pseudo."'";

        return $this->db->query($sql);
    }

    public function delete_compte($pseudo)
    {
        $pseudo = addslashes($pseudo);

        $sql = "DELETE FROM t_compte_cpt
                WHERE cpt_pseudo = '".$pseudo."'";

        return $this->db->query($sql);
    }


}
