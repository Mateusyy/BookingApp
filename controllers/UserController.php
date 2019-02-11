<?php

/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 23.04.2018
 * Time: 20:35
 */
class UserController extends Controller
{

    public function logout()
    {
//        $_SESSION = array();
//        unset($_SESSION['user']);
//        unset($_SESSION['user_id']);
//        unset($_SESSION['user_type']);
//        session_unset();
//        session_destroy();
//        To działa to wyżej nie koniecznie?!
        session_unset();
        session_destroy();
        $_SESSION = array();
        $this->redirect("/");
    }

    public function showMyProfile()
    {
        if ($_SESSION['zalogowany']) {
            $user = $this->model('user');
            $data['stuff'] = $user->loadUserInformations($_SESSION['user_id']);
            $this->partial('header',"Profil użytkownika");
            $this->partial('navigationBar');
            $this->user('showMyProfile',$data);
            $this->partial('footer');
        }else
            $this->redirect("/");
    }

    public function showMyOrders(){
        if(isset($_SESSION['zalogowany'])){
            $user = $this->model('user');

            $data = $user->loadUserOrders();
            $this->partial('header',"Moje rezerwacje");
            $this->partial('navigationBar');

            $this->user('showMyOrders', $data);

            $this->partial('footer');
        }else{
            $this->redirect('/');
        }
    }

    public function reservationComplete()
    {
        if(isset($_SESSION['zalogowany'])){
            if(isset($_POST['terminy'])){
                $this->showReservationComplete();
            }else{
                $this->redirect("/");
            }
        }else{
            if(isset($_POST['terminy'])){
                $this->redirect("/");
            }else{
                //tego nie widzi - ale w sumie nie potrzebne - moglby pokazac sie modal "ze cosik cza zaznaczyc"
                $this->redirect("/");
            }
        }
    }

    public function setAdditionalInformations(){
        if (!isset($_POST) || empty($_POST)){
            $this->redirect("/");
            echo "Error! Brak danych";
        }else{
            $user = $this->model("user");
            //if ($user->set_Additional_Informations($_POST)==false){return false;}
            //else{return true;}
            if($user->setAdditionalInformations($_POST))
                $this->showMyProfile();
            else
                $this->redirect("/");
        }
    }

    public function showReservationComplete()
    {
        $this->partial('header',"Potwierdzenie rezerwacji");
        $this->partial('navigationBar');
        $this->user('reservationComplete');
        $this->partial('modals/aintChoiceModal');
        $this->partial('modals/legendaModal');
        $this->partial('modals/logowanieModal');
        $this->partial('footer');
    }


    //password functions
    public function passwordChangeView(){
        if(!isset($_GET) || empty($_GET)){
            $this->redirect("/");
            die();
        }else{
            $user = $this->model('user');

            if($user->generateToken()){
                $this->partial("header", "Zmiana hasła");
                $this->partial("navigationBar");
                $this->user("passwordChange");
                $this->partial('modals/legendaModal');
                $this->partial('modals/logowanieModal');
                $this->partial("footer");
            }else{
                $this->pop("Przypominanie hasła",
                    "Błąd! Wykryto próbę oszustwa.",
                    "/");
            }
        }
    }


    public function passwordChangeFunc(){
        if(!isset($_GET) || empty($_GET)){
            $this->redirect("/");
            die();
        }else{
            $email = $_GET['email'];
            $myKey = $_GET['key'];
            $pass = $_POST['pass1'];

            $user = $this->model('user');
            if($user->changePassword($email, $myKey, $pass)){
                $this->partial("header", "Zmiana hasła");
                $this->partial("navigationBar");

                $this->pop("Przypominanie hasła",
                    "Hasło zmienione pomyślnie.",
                    "/");

                $this->partial('modals/legendaModal');
                $this->partial('modals/logowanieModal');
                $this->partial("footer");
            }else{
                $this->partial("header", "Zmiana hasła");
                $this->partial("navigationBar");

                $this->pop("Przypominanie hasła",
                    "Błąd. Spróbuj jeszcze raz.",
                    "/User/showMyProfile");

                $this->partial('modals/legendaModal');
                $this->partial('modals/logowanieModal');
                $this->partial("footer");
            }
        }
    }
}