<?php

/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 10.03.2018
 * Time: 16:25
 */
class User extends Model
{


    public function setAdditionalInformations($data)
    {
        $phone = trim($data['phone']);
        $firstname = trim($data['firstname']);
        $lastname = trim($data['lastname']);
        $sex = trim($data['sex']);
        $birthday = trim($data['birthday']);
        $city = trim($data['city']);
        $yourSport = trim($data['yourSport']);
        $comeFrom = trim($data['comeFrom']);
        $avatar = trim($data['avatar']);
        $user_id = $_SESSION['user_id'];


        $query = "UPDATE users SET phone = :phone, firstname = :firstname, lastname = :lastname ,sex = :sex, city = :city, birthday = :birthday, yourSport = :yourSport, comeFrom = :comeFrom, avatar = :avatar WHERE User_id = $user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':yourSport', $yourSport);
        $stmt->bindParam(':comeFrom', $comeFrom);

        if ($stmt->execute())
            return true;
        else
            return false;
    }


    //profil uzytkownika
    public function loadUserInformations($user_id)
    {
        $query = "SELECT * FROM users WHERE User_id = $user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //zamowienia uzytkownika
    public function  loadUserOrders(){
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM orders WHERE user_id = $user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $myResult = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($myResult, $row);
        }

        return $myResult;
    }

    //funckja wykorzystywana przy zmianie hasła w profilu user'a
    public function generateToken(){
        if(isset($_GET) || !empty($_GET)){
            $email = $_GET['email'];

            //sprawdza czy mejl jest w bazie
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            //dodaje token jesli mejl jest w bazie
            if ($stmt->rowCount() > 0){
                //generowanie i dodanie tokena
                $key = md5(rand(0, 1000));
                $_POST['key'] = $key;
                $query = "UPDATE users SET token = :key WHERE email = :email";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':key', $key);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
            }
            return true;
        }else{
            return false;
        }
    }

    public function changePassword($email, $myKey, $pass){
        //sprawdzanie czy token sie zgadza z mejlem
        $query = "SELECT * FROM users WHERE email = :email AND token = :myKey";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':myKey', $myKey);
        $stmt->execute();

        //jesli token z miejlem sie zgadza
        if ($stmt->rowCount() > 0){

            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

            $query = "UPDATE users SET password = :pass_hash WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':pass_hash', $pass_hash);
            $stmt->bindParam(':email', $email);

            if($stmt->execute())
                return true;
            else
                return false;
        }else{
            return false;
        }

    }
}