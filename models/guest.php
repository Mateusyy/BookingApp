<?php

/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 30.04.2018
 * Time: 13:47
 */
class guest extends Model
{
    //LOGOWANIE
    public function login($data)
    {
        $login = trim($data['login']);
        $password = trim($data['password']);
        $query = "SELECT * FROM users WHERE login = :login";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            if ($result['active'] == 1 and password_verify($password, $result['password'])) {
                $_SESSION['user'] = $result['login'];
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['user_type'] = $result['user_type'];
                return true;
            } else {
                unset($_SESSION['user']);
                unset($_SESSION['user_id']);
                unset($_SESSION['user_type']);
                return false;
            }
        } else {
            return false;
        }
    }

    //funkcja zwraca tablice z błędami - zamiast wartosci true/false sprawdzany na wyjsciu jest rozmiar tablicy
    //if 'rozmiar_tablicy' == 0   => wartosc true
    //else   => wartosc false
    public function register($data)
    {
        $errorHandler = array();
        $login = trim($data['login']);
        $password1 = trim($data['password1']);
        $validation = true;

        //captcha
        $secretKey = "6Lc7zlkUAAAAAMKiHtAw0fCENA8LumVaQCLyWjDX";
        $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $_POST['g-recaptcha-response']);
        $reply = json_decode($check);

        if ($reply->success == false) {
            array_push($errorHandler, "Chyba jesteś botem, zmień to!");
            $validation = false;
        }

        if ($validation == true) {
            $email = trim($data['email']);
            $firstname = trim($data['username']);
            $lastname = trim($data['surname']);
            $pass_hash = password_hash($password1, PASSWORD_DEFAULT);
//            32 char md5 wykorzystamy to potem w mailu
            $active = md5(rand(0, 1000));
            $_POST['key'] = $active;
            $query = "INSERT INTO users(user_id, login, password, email, firstname, lastname, user_type, active) 
                      VALUES (null, :login, :pass_hash, :email, :firstname, :lastname, 3, :active)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':pass_hash', $pass_hash);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':active', $active);
            $stmt->execute();
            return $errorHandler;
        } else {
            return $errorHandler;
        }
    }

    public function registerConfirmation($data)
    {
        $key = trim($data['key']);
        $email = trim($data['email']);
        $query = "SELECT * FROM users WHERE email = :email AND active = :active";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':active', $key);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $query = "UPDATE users SET active = 1 WHERE users.email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            if($stmt->execute()) return true;
            else return false;
        } else return false;
    }

    public function passwordChange($data){
        $password = trim($data['pass1']);
        $email = trim($data['email']);

        $pass_h = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE `users` SET `password`= :pass_h WHERE `email` = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass_h', $pass_h);

        if($stmt->execute())
            return true;
        else
            return false;
    }

    public function checkToken($data){
        $myKey = trim($data['key']);
        $email = trim($data['email']);
        $query = "SELECT * FROM users WHERE token = :myKey AND email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':myKey', $myKey);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }
}