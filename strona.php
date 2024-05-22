<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstA</title>
    <link rel="stylesheet" href="strona.css">
    <style>
        .user-profile {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>InstA</h1>
    </header>

    <nav>
        <ul>
            <li><a href="profile.php">Moje Konto</a></li> 
            <li><a href="#">Wiadomości</a></li>
            <li><a href="#">Znajomi</a></li>
            <li><a href="Login.php">Login</a></li>
            <li><a href="rejestracja.php">Utwórz konto</a></li>
        </ul>
    </nav>

    <section>
        <h2>Witaj na naszej stronie!</h2>
        <p>Witaj, jesteś samotny i nierozumiany przez społeczeństwo? Dobrze trafiłeś, tutaj poznasz masę samotnych i tajemniczych ludzi, którzy chętnie z tobą pogadają.</p>
        
        <div class="user-profiles">
            <?php
            $db = new mysqli('localhost', 'root', '', 'inst');

  
            $sql = "SELECT * FROM profil";


            $result = $db->query($sql);


            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {

                    echo "<div class='user-profile'>";
                    echo "<h3>" . $row['namee'] . " " . $row['surenamee'] . "</h3>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "Brak profili użytkowników.";
            }

            $db->close();
            ?>
        </div>
    </section>

    <footer>
        &copy; sadge
    </footer>
</body>
</html>
