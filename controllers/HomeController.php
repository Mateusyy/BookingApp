<?php

/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 06.03.2018
 * Time: 11:32
 */
class HomeController extends Controller
{

    //zaladowanie pierwszego widoku i wybranie odpowiedniego header'a
    public function index()
    {
        $this->partial('header');
        if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
            //sprawdz czy admin czy zwykly uzytkownik
            switch ($_SESSION['user_type']) {
                //admin
                case '1':
                    $this->partial('navigationBar');
                    $this->admin('todo');
                    break;
                //user
                case '3':
                    $this->partial('navigationBar');
                    $this->partial('calendar/mainCalendary');
                    $this->partial('bookButton');
                    $this->partial('modals/aintChoiceModal');
                    $this->partial('modals/legendaModal');
            }
        } else {
            //niezalogowany $ gość (guest)
            $this->partial('navigationBar');
            $this->partial('calendar/mainCalendary');
            $this->partial('bookButton');
            $this->partial('modals/aintChoiceModal');
            $this->partial('modals/legendaModal');
            $this->partial('modals/logowanieModal');
        }
        $this->partial('footer');
    }
}
