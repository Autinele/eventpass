<!-- evenements/participer.blade.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participer à l'événement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            font-size: 16px;
            color: #666;
        }

        label {
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-footer {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

    </style>
</head>

<body>
    <div class="container">
        <h1>Participer à l'événement : {{ $evenement->titre }}</h1>
        <p>{{ $evenement->description }}</p>

        <form action="{{ route('evenements.store-participant', $evenement->id) }}" method="POST">
            @csrf
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" required>

            <label for="last_name">Prénom :</label>
            <input type="text" name="last_name" id="last_name" required>

            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>

            <button type="submit">Participer</button>
        </form>

        <div class="form-footer">
            <p>Merci de vous inscrire pour participer à cet événement. Nous avons hâte de vous y voir !</p>
        </div>
    </div>
</body>

</html>
