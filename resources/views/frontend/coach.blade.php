<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coaching Islande</title>
    <!-- Chargement des fichiers CSS via Laravel Mix -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
    <div id="app">
        <island-coaching-hero></island-coaching-hero>
    </div>
    <!-- Chargement des fichiers JS via Laravel Mix -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
