<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur EventPass</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .bg {
            position: relative;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            background-color: #f0f0f0; /* Remplacez ici par la couleur souhaitée */
        }

        .welcome-text {
            color: rgb(81, 56, 248);
            font-size: 4em;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            z-index: 2;
            animation: fadeIn 3s ease-in-out infinite alternate;
            margin-bottom: 20px;
        }

        .button-connexion {
            background-color: rgb(81, 56, 248);
            color: white;
            padding: 10px 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            z-index: 2;
        }

        .top-right-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .event-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            text-align: center;
            max-width: 300px;
            display: inline-block;
            vertical-align: top;
        }

        .event-card h4 {
            margin-top: 10px;
            font-size: 1.5em;
            color: #333;
        }

        .event-card p {
            font-size: 1.2em;
            color: #666;
        }

        .event-card .btn-participer {
            background-color: rgb(81, 56, 248);
            color: white;
            padding: 10px 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .event-card .btn-participer.disabled {
            background-color: gray;
            cursor: not-allowed;
        }

        .error-message {
            color: red;
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            z-index: 2;
            margin-top: 20px;
            background-color: rgba(255, 0, 0, 0.1);
            border: 2px solid red;
            padding: 15px;
            border-radius: 5px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="bg">
        <div class="welcome-text">
            Bienvenue sur EventPass
        </div>

        <div class="container">
            <div class="row">
                @foreach ($evenements as $evenement)
                    @if ($evenement->statut === 'actif' && $evenement->participants_count < $evenement->limite_participants)
                        <div class="event-card">
                            <h4>{{ $evenement->titre }}</h4>
                            <p>{{ $evenement->description }}</p>
                            <p><strong>Date :</strong> {{ $evenement->date_debut }} - {{ $evenement->date_fin }}</p>
                            <p><strong>Participants :</strong> {{ $evenement->participants_count }} / {{ $evenement->limite_participants }}</p>
                            <a href="{{ route('evenements.participer', $evenement->id) }}" class="btn-participer">
                                Participer
                            </a>
                        </div>
                    @else
                        <div class="event-card">
                            <h4>{{ $evenement->titre }}</h4>
                            <p>{{ $evenement->description }}</p>
                            <p><strong>Date :</strong> {{ $evenement->date_debut }} - {{ $evenement->date_fin }}</p>
                            <p><strong>Participants :</strong> {{ $evenement->participants_count }} / {{ $evenement->limite_participants }}</p>
                            <button class="btn-participer disabled" disabled>
                                Plus de place
                            </button>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        @if (Auth::check())
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('dashboard') }}" class="button-connexion top-right-button">Dashboard</a>
        @else
            <div class="welcome-text">
                Accès réservé aux administrateurs uniquement.
            </div>
        @endif
    @else
        <a href="{{ route('login') }}" class="button-connexion top-right-button">Connexion</a>
    @endif
    </div>
</body>

</html>
