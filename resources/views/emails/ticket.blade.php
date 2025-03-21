<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Ticket pour l'Événement</title>
</head>
<body>
    <h1>Bonjour {{ $user->last_name }} {{ $user->name }},</h1>

    <p>Vous êtes inscrit à l'événement : <strong>{{ $evenement->titre }}</strong></p>
    <p><strong>Description :</strong> {{ $evenement->description }}</p>
    <p><strong>Date de l'événement :</strong> {{ $evenement->date_debut }} - {{ $evenement->date_fin }}</p>

    <p><strong>Votre ticket : <strong>{{ $ticket->ticket_code }}</strong></strong></p>
    <p>Voici votre ticket pour participer à l'événement. Vous êtes le participant numéro {{ $evenement->participants_count }}.</p>
</body>
</html>
