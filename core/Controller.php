<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 06.03.2018
 * Time: 11:28
 */

class Controller
{
    public function model($model){
        require_once 'models/'.$model.'.php';
        return new $model();
    }

    public function view($view, $data = []){
        require_once 'view/'.$view.'.php';
    }

    public function partial($part, $message=""){
        require_once 'view/partial/'.$part.'.php';
    }

    public function user($part, $data = []){
        require_once 'view/user/'.$part.'.php';
    }

    public function admin($part){
        require_once 'view/admin/'.$part.'.php';
    }

    public function moderator($part){
        require_once 'view/admin/'.$part.'.php';
    }

    public function guest($part){
        require_once 'view/guest/'.$part.'.php';
    }

    public function modal($part){
        require_once 'view/partial/modals/'.$part.'.php';
    }

    public function alert($message, $type){
        require_once 'view/partial/alert.php';
    }

    public function pop($header, $message, $action="#"){
        require_once 'view/partial/pop.php';
    }

    public function redirect($url){
        header('location: '.$url);
    }
}