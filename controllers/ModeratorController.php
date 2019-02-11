<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-05-08
 * Time: 09:48
 */

class ModeratorController extends Controller
{

    public function showModeratorPanel()
    {
        $this->partial('header',"Panel moderatora");
        if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
            //admin
            $this->moderator('navigationBar');

        } else {
            //user
            $this->redirect("/");
        }
        $this->partial('footer');
    }

}