<?php
class User{
    static function Register(string $email, string $password, string $name, string $surename) : bool   {
      
        $db = new mysqli('localhost', 'root', '', 'inst');
        $checkQuery = "SELECT id FROM user WHERE email = ?";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();
        if ($checkStmt->num_rows > 0) {
            
            return false;
        }

    
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);

        $insertQuery = "INSERT INTO user (email, password, name, surename) VALUES (?, ?, ?, ?)";
        $insertStmt = $db->prepare($insertQuery);
        $insertStmt->bind_param("ssss", $email, $passwordHash, $name, $surename);
        $result = $insertStmt->execute();

        $insertStmt->close();
        $db->close();

        return $result;
    }
}
?>

