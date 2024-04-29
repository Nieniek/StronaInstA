<?php
class User{

    static function Register(string $email, string $password, string $name, string $surename) : bool   {
        //user(id INT, email varchar(128) password varchar(128) name varchar(20) surename varchar(25) )

        $passwordHash = password_hash($password, PASSWORD_ARHON2I);

        $db = new mysqli('localhost', 'root', '', 'inst');

        $q = "INSERT INTO user (email, password, name, surename) Values (?,?,?,?)";

        $q = $db->prepare($sql);

        $q->bind_param("ss", $email, $passwordHash, $name, $surename);

        $result = $q->execute();

        return $result;

    }
}

?>