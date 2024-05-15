<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $db = new mysqli('localhost', 'root', '', 'inst');

   
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result['password'])) {
        
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['user_email'] = $result['email'];
        $_SESSION['user_name'] = $result['name'];
        $_SESSION['user_surename'] = $result['surename'];

        
        header("Location: profile.php");
        exit();
    } else {
        
        header("Location: login.php?error=1");
        exit();
    }

    $stmt->close();
    $db->close();
}
?>


