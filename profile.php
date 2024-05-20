<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$db = new mysqli('localhost', 'root', '', 'inst');


$sql = "SELECT * FROM profil 
        LEFT JOIN photo ON profil.profilePhotoID = photo.ID
        WHERE profil.ID=? 
        LIMIT 1";

$query = $db->prepare($sql);
$query->bind_param('i', $_SESSION['user_id']);
$query->execute();
$result = $query->get_result()->fetch_assoc();


if (!$result) {
    echo "Nie znaleziono profilu o podanym ID.";
    exit();
}

$name = $result['namee'];
$surename = $result['surenamee'];
$description = $result['description'];
$profilePhotoUrl = $result['url'];

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstA - Profil</title>
    <link rel="stylesheet" href="profil.css">
    <style>
       
    </style>
</head>
<body>
    <header>
        <h1>InstA</h1>
    </header>

    <nav>
        <ul>
            <li><a href="strona.html">Główna</a></li>
            <li><a href="#">Wiadomości</a></li>
            <li><a href="#">Znajomi</a></li>
           
        </ul>
    </nav>
    <section class="profile-section">
        <div class="profile-header">
            <h2>Twój Profil</h2>
        </div>
        <div class="profile-info-img">
            <div class="profile-info">
                <span id="name">
                    <?php echo $name." ".$surename; ?>
                </span>
                <img src="<?php echo $profilePhotoUrl; ?>" alt="" id="profilePhoto">
                <p id="profileDescription">
                    <?php echo $description; ?>
                </p>
            </div>
        </div>
    </section>

    <footer>
        &copy; sadge
    </footer>
</body>
</html>
