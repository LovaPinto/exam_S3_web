<?php
class DonController {
    
    public static function index() {
        $dons = Don::getAll();
        Flight::render('dons', ['dons' => $dons], 'body_content');
        Flight::render('layout', [
            'title' => 'Gestion des Dons',
            'active' => 'dons'
        ]);
    }

    public static function create() {
        $data = Flight::request()->data;
        
        $type = $data->type;
        $designation = $data->designation;
        $quantite = $data->quantite;
        $date_saisie = $data->date_saisie ?: null;

        if (empty($type) || empty($designation) || empty($quantite)) {
            Flight::redirect('/dons?error=' . urlencode('Tous les champs obligatoires doivent être remplis'));
            return;
        }

        try {
            Don::create($type, $designation, $quantite, $date_saisie);
            Flight::redirect('/dons?success=' . urlencode('Don ajouté avec succès'));
        } catch (Exception $e) {
            Flight::redirect('/dons?error=' . urlencode('Erreur: ' . $e->getMessage()));
        }
    }

    public static function delete($id) {
        try {
            Don::delete($id);
            Flight::redirect('/dons?success=' . urlencode('Don supprimé'));
        } catch (Exception $e) {
            Flight::redirect('/dons?error=' . urlencode('Erreur lors de la suppression'));
        }
    }
}
