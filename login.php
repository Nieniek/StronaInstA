<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row text-center mt-5">
            <h1>Logowanie</h1>
            <ul class="nav-links">
                <li><a href="strona.html">Strona Główna</a></li>
                <li><a href="rejestracja.php">Rejestracja</a></li>
                <li><a href="profile.php">Profil</a></li>
            </ul>
        </div>
        <div class="row">
            <form action="login_process.php" method="POST">
                <div class="mb-3 col-6 offset-3">
                    <label class="form-label w-100" for="emailInput">Email:</label>
                    <input class="form-control w-100" type="email" name="email" id="emailInput"> 
                </div>
                <div class="mb-3 col-6 offset-3">
                    <label class="form-label w-100" for="passwordInput" >Hasło</label>
                    <input class="form-control w-100" type="password" name="password" id="passwordInput">
                </div>
                <div class="mb-3 col-6 offset-3">
                    <button type="submit" class="btn btn-primary w-100">Zaloguj</button>
                </div>
            </form>
        </div>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

