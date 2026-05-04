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

        $model = model(\App\Models\Db_model::class);

        $role = $model->get_role_by_pseudo($pseudo);

        $data['titre'] = "Liste des Devis";

        // 🔥 plus de filtre par date
        if ($role && $role['pfl_role'] === 'A') {
            $data['dev'] = $model->get_all_dev(); // admin voit tout
        } else {
            $data['dev'] = $model->get_dev_by_user($pseudo); // user voit ses devis
        }

        // menu
        if ($role && $role['pfl_role'] === 'A') {
            $menu = 'menu_administrateur';
        } else {
            $menu = 'menu_membre';
        }

        return view('templates/haut2', $data)
            . view('menu/' . $menu)
            . view('affichage_dev', $data)
            . view('templates/bas2');
    }


    public function creer()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/connexion');
        }

        $pseudo = $session->get('user');
        $model = model(\App\Models\Db_model::class);

        $nb_pages = $this->request->getPost('nb_pages');
        $paiement = $this->request->getPost('paiement_ligne');

        // 🔥 calcul
        $duree = $nb_pages; // 1 page = 1 jour
        $montant = $duree * 300;

        if ($paiement === 'oui') {
            $duree += 3;
        }

        // 🔥 insertion
        $model->db->table('t_devis_dev')->insert([
            'dev_montant_estime' => $montant,
            'dev_duree_estime' => $nb_pages,
            'dev_duree_ml' => $duree,
            'dev_statut' => 'P',
            'dev_date_creation' => date('Y-m-d'),
            'cpt_pseudo' => $pseudo
        ]);

        return redirect()->to('/devis/lister_dev');
    }

    public function valider($id)
    {
        $db = \Config\Database::connect();

        $db->table('t_devis_dev')
            ->where('dev_id', $id)
            ->update([
                'dev_statut' => 'V',
                'dev_date_validation' => date('Y-m-d')
            ]);

        return redirect()->to('/devis/lister_dev');
    }


}