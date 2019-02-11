<?php

/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-04-26
 * Time: 00:42
 */
class AdminController extends Controller
{

    public function showAdminPanel()
    {
        $this->partial('header',"Panel administratora");
        if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
            //admin
            $this->partial('navigationBar');
            $this->admin('panel');
        } else {
            //user
            $this->redirect("/");
        }
        $this->partial('footer');
    }


    public function showAdminSettings()
    {
        $this->partial('header',"Ustawienia systemu");
        if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
            //admin
            $this->partial('navigationBar');
            $this->admin('settings');
        } else {
            //user
            $this->redirect("/");
        }
        $this->partial('footer');
    }

    public function showTodo()
    {
        $this->partial('header',"TODO");
        if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
            //admin
            $this->partial('navigationBar');
            $this->admin('todo');
        } else {
            //user
            $this->redirect("/");
        }
        $this->partial('footer');
    }

}