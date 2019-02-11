<?php

/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 17.03.2018
 * Time: 15:11
 */
class DBController extends Controller
{
    public function addRowOrders()
    {
        if (!isset($_POST) || empty($_POST)) {
            $this->redirect("/");
        } else {
            $user = $this->model('db');
            if ($user->addNewOrder($_POST) == false) {
//                funkcja zwrocila blad - niepoprawne wykonanie akcji w bazie
                $this->redirect("/");
            } else {
//                jezeli wszystko ok wyslij mail
                $user->sendMailMessage($_POST);
                $this->redirect("/");
            }
        }
    }

    public function find_by_login()
    {
        if (!isset($_POST))
            $this->redirect('/');
        else
            $login = trim($_POST['login']);
        $db = $this->model('db');
        if ($result = $db->find_by_login($login)) echo "false";
        else echo "true";
        return $result;
    }

    public function find_by_email()
    {
        if (!isset($_POST))
            $this->redirect('/');
        else
            $email = trim($_POST['email']);
        $db = $this->model('db');
        if ($result = $db->find_by_email($email)) echo "false";
        else echo "true";
        return $result;
    }

    public function getStatusName($id)
    {
        $user = $this->model('db');
        $result = $user->getStatusName($id);
        return $result;
    }

    public function getDBvalue($table, $param)
    {
        $user = $this->model('db');
        $result = $user->getDBValue($table, $param);
        return $result;
    }

    public function getStatusFromDB($date, $hour)
    {
        $db = $this->model('db');
        $result = $db->getStatusFromDB($date, $hour);
        return $result;
    }

    public function getUser($user_id)
    {
        $db = $this->model('db');
        $result = $db->getUser($user_id);
        return $result;
    }

    public function setOrderStatus()
    {
        if (!isset($_POST) || empty($_POST)) {
            $this->redirect("/");
            echo "Error! Brak danych";
        } else {
            $customSiteFunctions = $this->model('db');
            if ($customSiteFunctions->setOrderStatus($_POST) == false) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function updateSettings()
    {
        if (!isset($_POST) || empty($_POST)) {
            $this->redirect("/");
            echo "Error! Brak danych";
        } else {
            $db = $this->model('db');
            if ($db->setSettings($_POST) == false) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function remindPassword()
    {
        if (!isset($_POST) || empty($_POST)) {
            $this->redirect("/");
            echo "Error! Brak danych";
        } else {
            $db = $this->model('db');

            if ($db->remindPassword($_POST) == false) {
                echo "test1";
                return false;
            } else {
                $this->redirect("/");
                return true;
            }
        }
    }

}