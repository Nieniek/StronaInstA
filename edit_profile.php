<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new mysqli('localhost', 'root', '', 'inst');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $profilePhotoUrl = $_POST['profilePhotoUrl'];

    // Sprawdzenie zapytania SQL
    $stmt = $db->prepare("UPDATE profil SET description=?, url=? WHERE user_id=?");
    if ($stmt === false) {
        die("Błąd przygotowania zapytania: " . $db->error);
    }

    $stmt->bind_param('ssi', $description, $profilePhotoUrl, $_SESSION['user_id']);
    if ($stmt->execute()) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Błąd przy aktualizacji profilu: " . $stmt->error;
    }
} else {
    $stmt = $db->prepare("SELECT * FROM profil WHERE user_id=? LIMIT 1");
    if ($stmt === false) {
        die("Błąd przygotowania zapytania: " . $db->error);
    }

    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        $description = $result['description'];
        $profilePhotoUrl = $result['url'];
    } else {
        echo "Nie znaleziono profilu o podanym ID.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Profil</title>
    <link rel="stylesheet" href="profil.css">
</head>
<body>
    <header>
        <h1>InstA</h1>
    </header>

    <nav>
        <ul>
            <li><a href="strona.php">Główna</a></li>
            <li><a href="profile.php">Profil</a></li>
            <li><a href="logout.php">Wyloguj</a></li>
        </ul>
    </nav>
    <section class="profile-section">
        <div class="profile-header">
            <h2>Edytuj Profil</h2>
        </div>
        <div class="profile-info-img">
            <div class="profile-info">
                <form action="edit_profile.php" method="POST">
                    <div class="form-group">
                        <label for="description">Opis:</label>
                        <textarea name="description" id="description" class="form-control" rows="4"><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="profilePhotoUrl">URL zdjęcia profilowego:</label>
                        <input type="url" name="profilePhotoUrl" id="profilePhotoUrl" class="form-control" value="<?php echo htmlspecialchars($profilePhotoUrl); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        &copy; sadge
    </footer>
</body>
</html>
