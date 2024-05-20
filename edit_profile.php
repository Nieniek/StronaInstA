<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new mysqli('localhost', 'root', '', 'inst');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];

    if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['profilePhoto']['name']);

        if (move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $uploadFile)) {
            $photoUrl = $uploadFile;
            $stmt = $db->prepare("INSERT INTO photo (url) VALUES (?)");
            $stmt->bind_param('s', $photoUrl);
            $stmt->execute();
            $profilePhotoID = $stmt->insert_id;
        } else {
            echo "Błąd przy zapisywaniu zdjęcia.";
        }
    }

    if (isset($profilePhotoID)) {
        $stmt = $db->prepare("UPDATE profil SET description=?, profilePhotoID=? WHERE ID=?");
        $stmt->bind_param('sii', $description, $profilePhotoID, $_SESSION['user_id']);
    } else {
        $stmt = $db->prepare("UPDATE profil SET description=? WHERE ID=?");
        $stmt->bind_param('si', $description, $_SESSION['user_id']);
    }

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Błąd przy aktualizacji profilu.";
    }
} else {
    $stmt = $db->prepare("SELECT * FROM profil WHERE ID=? LIMIT 1");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        $description = $result['description'];
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
            <li><a href="strona.html">Główna</a></li>
            <li><a href="profile.php">Profil</a></li>
        </ul>
    </nav>
    <section class="profile-section">
        <div class="profile-header">
            <h2>Edytuj Profil</h2>
        </div>
        <div class="profile-info-img">
            <div class="profile-info">
                <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="description">Opis:</label>
                        <textarea name="description" id="description" class="form-control" rows="4"><?php echo $description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="profilePhoto">Zdjęcie profilowe:</label>
                        <input type="file" name="profilePhoto" id="profilePhoto" class="form-control">
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
