<?php

/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 31.03.2018
 * Time: 14:32
 */
class db extends Model
{
    //DO SPRAWDZANIA STATUSÓW WSZYSTKICH PRZYCISKÓW
    //=======
    public function getStatusFromDB($date, $hour)
    {
        $query = "SELECT * FROM orders WHERE orders.date='$date' and orders.hour='$hour'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $myResult = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($myResult, $row);
        }
        return $myResult;
    }

    //=======

    public function find_by_login($login)
    {
        $query = "SELECT * FROM users WHERE login = :login";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['user_id'];
        }else{
            return false;
        }
    }

    public function find_by_email($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['user_id'];
        }else{
            return false;
        }
    }

    public function getUser($user_id){
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function setOrderStatus($data)
    {
        $orderID = trim($data['orderID']);
        $id_status = trim($data['id_status']);

        $query = "UPDATE orders SET id_status = :id_status WHERE id_orders = '$orderID'";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_status', $id_status);

        if ($stmt->execute() == false) return false;
        else return true;
    }


    public function getStatusName($id)
    {
        $query = "SELECT status_name FROM status WHERE id_status='$id'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['status_name'];
    }

    public function getDBValue($table, $param)
    {
        $query = "SELECT $param FROM $table";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result[$param];
    }

    public function setSettings($data)
    {
        $siteTitle = trim($data['siteTitle']);
        $startHour = trim($data['startHour']);
        $endHour = trim($data['endHour']);
        $graduation = trim($data['graduation']);
        $daysAhead = trim($data['daysAhead']);
        $daysBehind = trim($data['daysBehind']);
        $whichSettings = trim($data['whichSettings']);
        $error = false;

        switch ($whichSettings) {

            case "calendarSettings":
                $query = 'UPDATE settings SET startHour = :startHour, endHour = :endHour, graduation = :graduation, daysAhead = :daysAhead WHERE id_settings = 1';
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':startHour', $startHour);
                $stmt->bindParam(':endHour', $endHour);
                $stmt->bindParam(':graduation', $graduation);
                $stmt->bindParam(':daysAhead', $daysAhead);
                break;

            case "systemSettings":
                $query = 'UPDATE settings SET siteTitle = :siteTitle, daysBehind = :daysBehind WHERE id_settings = 1';
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':siteTitle', $siteTitle);
                $stmt->bindParam(':daysBehind', $daysBehind);
                break;

            default:
                echo("Error! Brak parametru whichSettings");
                $error = true;
                break;
        }
        if ($error != true) {
            if ($stmt->execute() == false) {
                return false;
            }
        } else return true;
    }

    public function remindPassword($data)
    {
        $email = trim($data['email']);
        $query = "SELECT password FROM users WHERE email= :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        if ($stmt->execute() == false) {
            return false;
        } else {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $result['password'];
            return $result['password'];
        }
    }

    public function addNewOrder($data)
    {
        $user_id = $_SESSION['user_id'];
        //$secondName = trim($data['secondName']);
        //$telephoneNumber = trim($data['telephoneNumber']);
        //$email = trim($data['email']);
        $dates = $_POST['terminyFormated'];
        $error = false;

        foreach ($dates as $terminy) {
            $terminArray = explode("(", $terminy);
            $date = substr($terminArray[1], 0, 8);
            $hour = substr($terminArray[0], 0, 2);
            $query = "INSERT INTO orders (id_orders, date, hour, user_id, id_status) VALUES (NULL, :date, :hour, :user_id, 4)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':hour', $hour);
            $stmt->bindParam(':date', $date);
            if ($stmt->execute() == false) {
//           Błąd podczas dodawania do bazy danych
                $error = true;
            }
        }
        if ($error == true) return false;
        else                return true;
    }

    public function addUserOrder($data)
    {
        $firstName = trim($data['firstName']);
        $secondName = trim($data['secondName']);
        $telephoneNumber = trim($data['telephoneNumber']);
        $email = trim($data['email']);
        $dates = $_POST['terminyFormated'];
        $error = false;

        foreach ($dates as $terminy) {
            $terminArray = explode("(", $terminy);
            $date = substr($terminArray[1], 0, 8);
            $hour = substr($terminArray[0], 0, 2);
            $query = "INSERT INTO orders (id_orders, date, hour, name, surname, email, tel, id_status) VALUES (NULL, :date, :hour, :firstName, :secondName, :email, :telephoneNumber, 4)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':secondName', $secondName);
            $stmt->bindParam(':telephoneNumber', $telephoneNumber);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':hour', $hour);
            $stmt->bindParam(':date', $date);
            if ($stmt->execute() == false) {
//           Błąd podczas dodawania do bazy danych
                $error = true;
            }
        }
        if ($error == true) return false;
        else                return true;
    }


    public function sendMailMessage($data)
    {
        require_once "functions.php";
        $firstName = trim($data['firstName']);
        $secondName = trim($data['secondName']);
        $telephoneNumber = trim($data['telephoneNumber']);
        $to = trim($data['email']);

        $subject = "[SROS] Potwierdzenie rezerwacji";
        $message = "
                    <html><head><title>[SROS] Potwierdzenie rezerwacji</title></head><body>

                <h2 style='display: inline; vertical-align: middle'>
                <img style='vertical-align: middle; margin-right: 20px; height: 32px; width: 32px' src='http://hala.siolkowa.pl/content/favicon-32x32.png'>
                Potwierdzenie rezerwacji</h2>
     
            <table style='border: 1px solid #ccc; border-collapse: collapse; margin: 0; padding: 0; width: 100%; table-layout: fixed;'>
              <caption style='font-size: 1.5em; margin: .5em 0 .75em;'>Dane rezerwującego</caption>
              <thead>
                <tr style='background: #f8f8f8; border: 1px solid #ddd; padding: .35em;'>
                  <th style='font-size: .85em; letter-spacing: .1em; text-transform: uppercase; padding: .625em; text-align: center;' scope=\"col\">Imię</th>
                   <th style='font-size: .85em; letter-spacing: .1em; text-transform: uppercase; padding: .625em; text-align: center;' scope=\"col\">Nazwisko</th>
                   <th style='font-size: .85em; letter-spacing: .1em; text-transform: uppercase; padding: .625em; text-align: center;' scope=\"col\">Telefon kontaktowy</th>
                </tr>
              </thead>
              <tbody>
               <tr style='background: #f8f8f8; border: 1px solid #ddd; padding: .35em;'>
                  <td style='padding: .625em; text-align: center;' data-label=\"Imię\">$firstName</td>
                  <td style='padding: .625em; text-align: center;' data-label=\"Nazwisko\">$secondName</td>
                  <td style='padding: .625em; text-align: center;' data-label=\"Telefon kontaktowy\">$telephoneNumber</td>
                </tr>
              </tbody>
            </table>
            <table style='border: 1px solid #ccc; border-collapse: collapse; margin: 0; padding: 0; width: 100%; table-layout: fixed;'>
              <caption style='font-size: 1.5em; margin: .5em 0 .75em;'>Wybrane rezerwacje</caption>
              <thead>
                <tr style='background: #f8f8f8; border: 1px solid #ddd; padding: .35em;'>
                    <th style='font-size: .85em; letter-spacing: .1em; text-transform: uppercase; padding: .625em; text-align: center;' scope=\"col\">#</th>
                    <th style='font-size: .85em; letter-spacing: .1em; text-transform: uppercase; padding: .625em; text-align: center;' scope=\"col\">Data rezerwacji</th>
                    <th style='font-size: .85em; letter-spacing: .1em; text-transform: uppercase; padding: .625em; text-align: center;' scope=\"col\">Godzina</th>
                </tr>
              </thead>
              <tbody>" . getReservationMailTerms("terminyFormated") . "   
            </tbody>
            </table>
            
            <div style='margin: 5px;'>
              <p style='font-size:14px;'>Sprawdź poprawność danych. Jeżeli wprowadzone dane są poprawne kliknij w przycisk by potwierdź rezerwację:
              <a style=' text-decoration:none; display:inline-block; padding:10px; margin-left:15px; margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;border-radius:4px; color:#fff;background-color:#5cb85c;border-color:#4cae4c;' href='#'>Potwierdzam rezerwację</a>
            </p>
            <b> Wprowadzenie nieautentycznych danych może skutkować odrzuceniem rezerwacji </b>
            </div>
            <div style='text-align: center'>
            <small style='text-align: center'>Jeżeli nie rozumiesz tego maila, nie rezerwowałeś sali w naszym serwisie, powyższe dane osobowe Cie nie dotyczą - zignoruj tę wiadomość bądź skontaktuj się z administratorem serwisu: <a href='www.hala.siolkowa.pl' target='_blank'>hala.siolkowa.pl</a> 
                   <br> Ta wiadomość została wygenerowana automatycznie - prosimy na nią nie odpowiadać </small>
            </div>

                </body></html>";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <hala@siolkowa.pl>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
}