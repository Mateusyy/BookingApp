<?php

/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-04-26
 * Time: 00:37
 */
class GuestController extends Controller
{

    public function login()
    {
        if (!isset($_POST) || empty($_POST)) {
            $_SESSION['zalogowany'] = false;
            $_SESSION['blad'] = false;
            $this->redirect("/");
            die();
        } else {
            $guest = $this->model('guest');
            if ($guest->login($_POST)) {
                $_SESSION['zalogowany'] = true;
                $_SESSION['blad'] = false;

//                if(isset($_POST['anythingCheck'])){
//                    echo $_POST['anythingCheck'];
//                }else{
//                    echo "nie ustawiona";
//                }

//                if(($_POST['anythingCheck']) == 'true'){
//                    //$this->remindPassword();
//                    echo "elo";
//                }else{
//                    //$this->redirect('/');
//                    echo "elo";
//                    echo $_POST['anythingCheck'];
//                }
                $this->redirect('/');


            } else {
                $_SESSION['zalogowany'] = false;
                $_SESSION['blad'] = true;
                $this->redirect("/");
            }
        }
    }

    public function remindPasswordView()
    {
        $this->partial('header', "Przypomnij hasło");
        $this->partial('navigationBar');
        $this->guest('passwordRemindPage');
        $this->partial('footer');
    }

    public function remindPasswordFunc(){
        if(!isset($_POST) || empty($_POST)){
            $this->redirect('/');
            die();
        }else{
            $email = $this->model("mail");

            $this->partial("header", "Przypominanie hasła");
            $this->partial("navigationBar");

            if($email->passwordRemind($_POST)){
                $this->pop("Przypominanie hasła",
                    "Właśnie wysłaliśmy do Ciebie maila z dalszymi instrukcjami odnośnie resetowania hasła. Sprawdź skrzynkę e-mail'ową.",
                    "/");
            }else{
                $this->pop("Przypominanie hasła",
                    "Nie możemy dopasować żadnego użytkownika do podanego adresu. Spróbuj ponownie.",
                    "/Guest/remindPasswordView");
            }


            $this->partial('modals/legendaModal');
            $this->partial('modals/logowanieModal');
            $this->partial("footer");
        }
    }

    public function passwordChangeView(){
        if (!isset($_GET) || empty($_GET) || $_SESSION['zalogowany']) {
            $this->redirect("/");
            die();
        } else {

            $guest = $this->model("guest");
            if($guest->checkToken($_GET)){
                $this->partial("header", "Zmiana hasła");
                $this->partial("navigationBar");
                $this->guest("passwordChange");
                $this->partial('modals/legendaModal');
                $this->partial('modals/logowanieModal');
                $this->partial("footer");
            }else{
                $this->redirect('/');
            }
        }
    }


    public function passwordChangeFunc(){
        if(!isset($_POST) || empty($_POST) || !isset($_GET) || empty($_GET)){
            $this->redirect('/');
            die();
        }else{
            $guest = $this->model("guest");

            if($guest->checkToken($_GET)) {
                $this->partial("header", "Zmiana hasła");
                $this->partial("navigationBar");

                if ($guest->passwordChange($_POST)) {
                    $this->pop("Zmiana hasła",
                        "Hasło zostało zmienione. Możesz się zalogować.",
                        "/");
                } else {
                    $this->pop("Zmiana hasła",
                        "Coś poszło nie tak.",
                        "/Guest/remindPasswordView");
                }

                $this->partial('modals/legendaModal');
                $this->partial('modals/logowanieModal');
                $this->partial("footer");
            }else{
                $this->redirect('/');
            }

        }
    }



    public function register_page()
    {
        if ($_SESSION['zalogowany'])
            $this->redirect('/');
        else {
            $this->partial("header", "Zarejestruj");
            $this->partial("navigationBar");
            $this->guest("registerPage");
            $this->partial('modals/legendaModal');
            $this->partial('modals/logowanieModal');
            $this->partial("footer");
        }
    }

    //argumentem jest tablica z błedami podczas logowania
    public function register_page_error($errorHandler)
    {
        if ($_SESSION['zalogowany']) {
            $this->redirect('/');
        } else {
            $this->partial("header", "Zarejestruj");
            $this->partial("navigationBar");
            $this->partial('calendar/mainCalendary');
            //zmienna pomocnicza
            $errors = "";
            //wypełnienie zmiennej błedami z tablicy (arg) w odpowiedni sposob
            for ($i = 0; $i <= count($errorHandler); $i++) {
                $errors = $errors . "$errorHandler[$i]" . "<br>";
            }

            $this->pop("Coś poszło nie tak :/", $errors);
            $this->guest("registerPage");
            $this->partial('modals/legendaModal');
            $this->partial('modals/logowanieModal');
            $this->partial("footer");
        }
    }

    public function register()
    {
        if (!isset($_POST) || empty($_POST) || $_SESSION['zalogowany']) {
            $this->redirect("/");
            die();
        } else {
            $guest = $this->model('guest');
            $errorHandler = $guest->register($_POST);
            if (count($errorHandler) <= 0) {
//                Wyślij maila
                $mail = $this->model('mail');
                $mail->registerConfirmation($_POST);
                $this->partial("header", "Pomyślnie utworzono konto");
                $this->partial("navigationBar");
                $this->partial('calendar/mainCalendary');
                $this->pop("Pomyślnie utworzono konto",
                    "Właśnie wysłaliśmy do ciebie maila z linkiem potwierdzającym rejestracje konta.",
                    "/");
                $this->partial('modals/legendaModal');
                $this->partial('modals/logowanieModal');
                $this->partial("footer");
            } else {
//                Załaduj stronę z błędem
                $this->register_page_error($errorHandler);
            }
        }
    }

    public function registerConfirmation()
    {
        if (!isset($_GET) || empty($_GET) || $_SESSION['zalogowany']) {
            $this->redirect("/");
            die();
        } else {
            $guest = $this->model('guest');
            if ($guest->registerConfirmation($_GET)) {
                $this->partial("header", "Pomyślnie aktywowano konto");
                $this->partial("navigationBar");
                $this->pop("Pomyślnie aktywowano konto",
                    "Twoje konto zostało aktywowane.",
                    "/");
                $this->partial('modals/legendaModal');
                $this->partial('modals/logowanieModal');
                $this->partial("footer");
            } else {
                $this->partial("header", "Coś poszło nie tak");
                $this->partial("navigationBar");
                $this->partial('calendar/mainCalendary');
                $this->pop("Coś poszło nie tak :/",
                    "W celu uzyskania pomocy skontaktuj się z administratorem systemu",
                    "/");
                $this->partial('modals/legendaModal');
                $this->partial('modals/logowanieModal');
                $this->partial("footer");
            }
        }
    }
}