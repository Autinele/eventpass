<?php

namespace App\Http\Controllers;

use App\Mail\TicketMail;
use App\Models\Evenement;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer tous les événements
        $evenements = Evenement::all();
        return view('evenements.index', compact('evenements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Afficher le formulaire de création d'événement
        return view('evenements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        // Créer un nouvel événement
        Evenement::create($request->all());

        return redirect()->route('evenements.index')->with('success', 'Événement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Afficher un événement spécifique
        $evenement = Evenement::findOrFail($id);
        return view('evenements.show', compact('evenement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Afficher le formulaire de modification d'événement
        $evenement = Evenement::findOrFail($id);
        return view('evenements.edit', compact('evenement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valider les données
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        // Mettre à jour l'événement
        $evenement = Evenement::findOrFail($id);
        $evenement->update($request->all());

        return redirect()->route('evenements.index')->with('success', 'Événement mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Supprimer l'événement du softDeletes
         $evenement = Evenement::findOrFail($id);
         $evenement->delete();

         return redirect()->route('evenements.index')->with('success', 'Événement supprimé.');
    }

    public function showParticipants()
    {
        // Récupérer tous les événements avec leurs participants
        $evenements = Evenement::with('participants.user')->get();

        return view('evenements.participants', compact('evenements'));
    }



public function indexUtilisateur()
{
    $utilisateurs = User::all(); // Récupération de tous les utilisateurs
    return view('evenements.utilisateurs', compact('utilisateurs'));
}

public function evenementActif()
{
    $evenements = Evenement::where('statut', 'actif')->get();
    return view('evenements.evenement_actifs', compact('evenements'));
}

public function evenementExpire()
    {
        $evenements = Evenement::where('statut', 'expiré')->get();
        return view('evenements.evenement_expire', compact('evenements'));
    }


    public function evenementSupprimer()
    {
        $evenements = Evenement::onlyTrashed()->get();  // Soft delete
        return view('evenements.evenement_supprimer', compact('evenements'));
    }

    public function participer($evenementId, Request $request)
{
    $evenement = Evenement::findOrFail($evenementId);

    // Vérifier si l'événement est actif et s'il reste des places
    if ($evenement->statut !== 'actif' || $evenement->participants_count >= $evenement->limite_participants) {
        // Rediriger avec un message d'erreur si la limite est atteinte ou l'événement est inactif
        return redirect()->route('evenements.index')->with('error', 'Désolé, cet événement est complet ou inactif.');
    }

    // Créer ou récupérer l'utilisateur
    $user = User::firstOrCreate(
        ['email' => $request->email],
        [
            'nom' => $request->name,
            'prenom' => $request->last_name,
            'password' => bcrypt('password'), // Mot de passe par défaut
        ]
    );

    // Ajouter le participant à l'événement
    $evenement->participants()->attach($user->id);

    // Mettre à jour le nombre de participants
    $evenement->increment('participants_count'); // Incrémente de 1 le nombre de participants

    // Créer un ticket unique pour l'utilisateur
    $ticketCode = Str::random(20); // Générer un ticket unique
    $ticket = Ticket::create([
        'evenement_id' => $evenement->id,
        'user_id' => $user->id,
        'ticket_code' => $ticketCode,
    ]);

    // Envoyer un ticket par email
    Mail::to($request->email)->send(new TicketMail($ticket, $evenement));

    // Rediriger avec un message de succès
    return redirect()->route('evenements.show', $evenementId)->with('success', 'Vous êtes inscrit à l\'événement!');
}


public function allevents()
{
    // Récupérer tous les événements actifs
    $evenements = Evenement::where('statut', 'actif')->get();

    // Passer les événements à la vue
    return view('welcome', compact('evenements'));
}

}
