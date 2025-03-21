<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        // Compter le nombre d'événements actifs
        $nombreEvenementsActifs = Evenement::where('statut', 'actif')->count();

        // Compter le nombre d'événements expirés
$expiredEventsCount = Evenement::where('date_fin', '<', now())
->where('statut', 'expiré') // Vérifier que l'événement est marqué comme expiré
->count();


       // Nombre total de participants à tous les événements
    $totalParticipantsCount = Evenement::sum('participants_count');

        // Compter le nombre total d'utilisateurs
        $nombreUtilisateurs = User::count();


        // Retourner la vue avec les données
        return view('dashboard', [
            'nombreEvenementsActifs' => $nombreEvenementsActifs,
            'expiredEventsCount' => $expiredEventsCount,
            'totalParticipantsCount' => $totalParticipantsCount,
            'nombreUtilisateurs' => $nombreUtilisateurs,
        ]);
    }
}
