<?php

namespace App\Controllers;

use App\Models\Db_model;

class Devis extends BaseController
{
    public function __construct()
    {
        //...
    }

    public function lister_dev()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/connexion');
        }

        $pseudo = $session->get('user');
        $model  = model(\App\Models\Db_model::class);
        $role   = $model->get_role_by_pseudo($pseudo);

        $data['titre'] = "Liste des Devis";

        if ($role && $role['pfl_role'] === 'A') {
            $data['dev'] = $model->get_all_dev();
            $param = $model->get_parametre('tarif_journalier');
            $data['tarif_journalier'] = $param ? $param['prm_valeur'] : 300;
            $vue_devis = 'affichage_dev_admin';
            $menu      = 'menu_administrateur';
        } else {
            $data['dev'] = $model->get_dev_by_user($pseudo);
            $vue_devis = 'affichage_dev';
            $menu      = 'menu_membre';
        }

        return view('templates/haut2', $data)
            . view('menu/' . $menu)
            . view($vue_devis, $data)
            . view('templates/bas2');
    }


public function creer()
{
    $session = session();

    if (! $session->has('user')) {
        return redirect()->to('/connexion');
    }

    $pseudo = $session->get('user');

    $nb_pages = (int) $this->request->getPost('nb_pages');
    $paiement = $this->request->getPost('paiement_ligne');

    $duree = $nb_pages;

    if ($paiement === 'oui') {
        $duree += 3;
    }

    $tarif = 300; // ✅ plus de table t_config

    $montant = $duree * $tarif;
    $date    = date('Y-m-d');

    $db = \Config\Database::connect();

    $db->transStart();

    // Insert devis
    $db->table('t_devis_dev')->insert([
        'dev_montant_estime' => $montant,
        'dev_duree_estime'   => $duree,
        'dev_statut'         => 'P',
        'dev_date_creation'  => $date,
        'cpt_pseudo'         => $pseudo,
    ]);

    $dev_id = $db->insertID();

    // Insert détail
    $db->table('t_detail_det')->insert([
        'dev_id'          => $dev_id,
        'det_nom'         => $this->request->getPost('det_nom'),
        'det_description' => $this->request->getPost('det_description')
    ]);

    $db->transComplete();

    return redirect()->to('/devis/lister_dev');
}


    public function valider($id)
    {
        $db = \Config\Database::connect();

        $db->table('t_devis_dev')
            ->where('dev_id', $id)
            ->update([
                'dev_statut'          => 'V',
                'dev_date_validation' => date('Y-m-d'),
            ]);

        return redirect()->to('/devis/lister_dev');
    }

    public function modifier_tarif()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/connexion');
        }

        $model = model(\App\Models\Db_model::class);
        $role  = $model->get_role_by_pseudo($session->get('user'));

        if (! $role || $role['pfl_role'] !== 'A') {
            return redirect()->to('/devis/lister_dev');
        }

        $nouveau_tarif = (int) $this->request->getPost('tarif_journalier');

        if ($nouveau_tarif > 0) {
            $db     = \Config\Database::connect();
            $existe = $model->get_parametre('tarif_journalier');

            if ($existe) {
                // 🔥 bonne table : t_parametre_prm
                $db->table('t_parametre_prm')
                ->where('prm_cle', 'tarif_journalier')
                ->update(['prm_valeur' => $nouveau_tarif]);
            } else {
                $db->table('t_parametre_prm')
                ->insert([
                    'prm_cle'    => 'tarif_journalier',
                    'prm_valeur' => $nouveau_tarif,
                ]);
            }
        }

        return redirect()->to('/devis/lister_dev');
    }

    public function modifier_montant($id)
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/connexion');
        }

        $pseudo = $session->get('user');
        $model  = model(\App\Models\Db_model::class);
        $role   = $model->get_role_by_pseudo($pseudo);

        if (! $role || $role['pfl_role'] !== 'A') {
            return redirect()->to('/devis/lister_dev');
        }

        $nouveau_montant = (int) $this->request->getPost('montant');

        if ($nouveau_montant < 0) {
            return redirect()->to('/devis/lister_dev')->with('error', 'Montant invalide.');
        }

        $db = \Config\Database::connect();
        $db->table('t_devis_dev')
            ->where('dev_id', (int) $id)
            ->update(['dev_montant_estime' => $nouveau_montant]);

        return redirect()->to('/devis/lister_dev')->with('success', 'Montant mis à jour.');
    }

    public function supprimer($id)
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/connexion');
        }

        $db = \Config\Database::connect();

        // 🔴 transaction pour éviter les bugs
        $db->transStart();

        // 1️⃣ supprimer d'abord les détails (IMPORTANT)
        $db->table('t_detail_det')->where('dev_id', $id)->delete();

        // 2️⃣ supprimer le devis
        $db->table('t_devis_dev')->where('dev_id', $id)->delete();

        $db->transComplete();

        return redirect()->to('/devis/lister_dev');
    }
}