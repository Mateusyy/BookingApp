<?php

/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-05-20
 * Time: 13:22
 */
class mail extends Model
{
    public function registerConfirmation($data)
    {
        $login = trim($data['login']);
        $to = trim($data['email']);
        $username = trim($data['username']);
        $key = $_POST['key'];
        $subject = "[Zagrałbym.pl] Potwierdzenie rejestracji";
        $message = "
        <html>
            <head>
                <title>$subject</title>
            </head>
            <body>
            
            <div style='text-align: center'>
                <h2 style='display: inline; vertical-align: middle; text-align: center' >
                <img src='http://zagralbym.pl/content/logo.png' style='vertical-align: middle; margin-right: 20px; height: 64px; width: 64px'>
                Potwierdzenie rejestracji</h2>
                </div>
     
                <p>Witaj $username!</p>
                <p>Dziękujemy za rejestracje w naszym serwisie: <a href='http://zagralbym.pl/'>Zagrałbym.pl</a></p>
                <p>Twój login: $login</p>                                
                <p>Kliknij w link by potwierdzić swoją rejestrację i w pełni korzystać z aplikacji: <a href='http://zagralbym.pl/Guest/registerConfirmation?email=$to&key=$key'> ---> LINK <--- </a></p>
                
                <div style='text-align: center'>
                <small style='text-align: center'>Jeżeli nie rozumiesz tego maila, nie rejestrowałeś konta w naszym serwisie, powyższe dane osobowe Cie nie dotyczą - zignoruj tę wiadomość bądź skontaktuj się z administratorem serwisu: <a href='www.zagralbym.pl' target='_blank'>zagralbym.pl</a> 
                       <br> Ta wiadomość została wygenerowana automatycznie - prosimy na nią nie odpowiadać </small>
                </div>
            </body>
        </html>";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <admin@Zagralbym.pl>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    public function passwordRemind($data){
        $email = trim($data['email']);

        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if($stmt->rowCount() > 0){

            //nadanie tokena
            $key = md5(rand(0, 1000));
            //$_POST['key'] = $key;
            $query = "UPDATE users SET token = :key WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':key', $key);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $subject = "[Zagrałbym.pl] Zmiana hasła";
            $message = "
                        <html>
                            <head>
                                <title>$subject</title>
                            </head>
                            <body>
                            
                            <div style='text-align: center'>
                                <h2 style='display: inline; vertical-align: middle; text-align: center' >
                                <img src='http://zagralbym.pl/content/logo.png' style='vertical-align: middle; margin-right: 20px; height: 64px; width: 64px'>
                                <br/>Zmiana hasła</h2>
                                </div>
                     
                                <p>Witaj $email!</p>
                                <p><a href='http://zagralbym.pl/'>Zagrałbym.pl</a></p>
                                <p>Resetowanie hasła</p>                                
                                <p>Aby zmienić hasło kliknij w poniższy link</p>
                                <p><a href='http://zagralbym.pl/Guest/passwordChangeView?email=$email&key=$key'> #-- LINK --# </a></p>
                                
                                <div style='text-align: center'>
                                <small style='text-align: center'>Jeżeli nie rozumiesz tego maila, nie rejestrowałeś konta w naszym serwisie, powyższe dane osobowe Cie nie dotyczą - zignoruj tę wiadomość bądź skontaktuj się z administratorem serwisu: <a href='www.zagralbym.pl' target='_blank'>zagralbym.pl</a> 
                                       <br> Ta wiadomość została wygenerowana automatycznie - prosimy na nią nie odpowiadać </small>
                                </div>
                            </body>
                        </html>";

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // More headers
                $headers .= 'From: <admin@Zagralbym.pl>' . "\r\n";
                mail($email, $subject, $message, $headers);

            return true;
        }else{
            return false;
        }
    }
}