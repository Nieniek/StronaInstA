<?php
$db = new mysqli('localhost', 'root', '', 'inst');

require_once('class/User.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['surename'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $surename = $_POST['surename'];

        $passwordRepeat = $_POST['passwordrepeat'];
        if ($password !== $passwordRepeat) {
            echo "Błąd przy rejestracji: hasła nie są zgodne.";
            exit; 
        }

        
        $result = User::Register($email, $password, $name, $surename);

        if ($result) {
           
            $userId = $db->insert_id;

            
            $stmt = $db->prepare("INSERT INTO profil (user_id, namee, surenamee) VALUES (?, ?, ?)");
            $stmt->bind_param('iss', $userId, $name, $surename);
            if ($stmt->execute()) {
                echo "Udało się utworzyć konto i profil.";
                header("Location: profile.php");
                exit();
            } else {
                echo "Nie udało się utworzyć profilu.";
            }
        } else {
            echo "Nie udało się utworzyć konta.";
        }
    } else {
        echo "Nieprawidłowe dane formularza.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="rejestracja.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row text-center mt-5">
            <h1>Rejestracja</h1>
            <ul class="nav-links">
                <li><a href="strona.php">Strona Główna</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="profile.php">Profil</a></li>
            </ul>
        </div>
        <div class="row">
            <form action="rejestracja.php" method="POST">
                <div class="mb-3 col-6 offset-3">
                    <label class="form-label w-100" for="nameInput">Imię</label>
                    <input class="form-control w-100" type="text" name="name" id="nameInput" required>
                </div>
                <div class="mb-3 col-6 offset-3">
                    <label class="form-label w-100" for="surenameInput">Nazwisko</label>
                    <input class="form-control w-100" type="text" name="surename" id="surenameInput" required>
                </div>
                <div class="mb-3 col-6 offset-3">
                    <label class="form-label w-100" for="emailInput">Email:</label>
                    <input class="form-control w-100" type="email" name="email" id="emailInput" required>
                </div>
                <div class="mb-3 col-6 offset-3">
                    <label class="form-label w-100" for="passwordInput">Hasło</label>
                    <input class="form-control w-100" type="password" name="password" id="passwordInput" required>
                </div>
                <div class="mb-3 col-6 offset-3">
                    <label class="form-label w-100" for="passwordRepeatInput">Powtórz Hasło</label>
                    <input class="form-control w-100" type="password" name="passwordrepeat" id="passwordRepeatInput" required>
                </div>
                <div class="mb-3 col-6 offset-3">
                    <button type="submit" class="btn btn-primary w-100">Zarejestruj</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

